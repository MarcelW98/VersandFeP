import BaseComponent from '../../baseComponent';
import ElementWithComponent from '../../ElementWithComponent';
import Box from '../../atoms/box';

const LONG_CAPTION_CLASS = '-long-caption';
const FIGCAPTION_OPEN_CLASS = '-open';
const IMAGE_ACTIVE_CLASS = '-active';
const mobileWidth = 768;
class Lightbox extends BaseComponent {

  protected static events = [
    'closeClicked',
    'next',
    'back',
    'backgroundClicked',
  ];

  /**
   * the underlying box component
   */
  private box: Box;

  /**
   * returns a valid lightbox ID to place into the modal box for the given string
   */
  public static lightboxId = (id: string): string =>
    `frontend-kit-lightbox-${id}`;

  /**
   * finds a lightbox with the given ID
   */
  public static findLightbox = (
    id: string,
    getElementByID: typeof window.document.getElementById = (id: string) => window.document.getElementById(Lightbox.lightboxId(id))
  ): ElementWithComponent<Box> | null => {

    return getElementByID(id) as ElementWithComponent<Box>;
  }

  /**
   * shows the modal with the given modal ID, if it exists
   */
  public static showLightbox = (id: string): void => {
    const lightboxElement = Lightbox.findLightbox(id);

    if (!lightboxElement) {
      console.warn(`Could not find a lightbox with id ${id} to show.`);
    } else {
      lightboxElement.component.show();
    }
  };

  /**
   * hides the modal with the given modal ID, if it exists
   */
  public static hideLightbox = (id: string): void => {
    const lightboxElement = Lightbox.findLightbox(id);

    if (!lightboxElement) {
      console.warn(`Could not find a lightbox with id ${id} to hide.`);
    } else {
      lightboxElement.component.hide();
    }
  };

  /**
   * wrapper of lightbox which determines the complete hight of the lightbox
   */
  private readonly wrapper: HTMLElement;
  /**
   * An array of images used in the lightbox
   */
  private readonly images: NodeListOf<Element>;
  /**
   * A counter element
   */
  private readonly counter: HTMLElement;
  /**
   * A next button element
   */
  private readonly nextButton: HTMLElement;
  /**
   * A back button element
   */
  private readonly backButton: HTMLElement;
  /**
   * A close button element
   */
  private readonly closeButton: HTMLElement;
  /**
   * A collapse button element
   */
  private readonly expandButton: HTMLElement;
  /**
   * Boolean if light box is extended variant
   */
  private readonly extended: boolean;
  /**
   * Boolean if light box is sequence variant
   */
  private readonly sequence: boolean;
  /**
   * Boolean if light box is open
   */
  private isOpen: boolean;
  /**
   * Boolean if light box is in mobile viewport
   */
  private isMobile: boolean;
  /**
   * Index of currently shown image
   */
  private currentIndex: number = 0;

  constructor(container: HTMLElement) {
    super(container);

    //inner state of the component
    this.extended = false;
    this.sequence = false;
    this.isOpen = false;
    this.isMobile = window.outerWidth < mobileWidth;

    // determine variant of the light box
    if (this.container.classList.contains('-extended')) this.extended = true;
    if (this.container.classList.contains('m-lightbox--sequence')) this.sequence = true;

    // adding resize handler to watch if caption is to long
    // if to long show expand control
    // only run when light box is open
    // set boolean if mobile viewport
    window.addEventListener('resize', () => {
      this.isMobile = window.outerWidth < mobileWidth;

      if (this.isOpen && this.extended) {
        this.toggleCaption(true);
        this.toggleExpandButton(true);

        if (this.isCaptionToLong()) {
          this.container.classList.add(LONG_CAPTION_CLASS);
        } else {
          this.container.classList.remove(LONG_CAPTION_CLASS);
        }
      }

    })

    // get all relevant elements for further handling
    this.wrapper = container.querySelector('.m-lightbox__wrapper');
    this.images = container.querySelectorAll('.a-image');
    this.counter = container.querySelector('.m-lightbox__counter');
    this.closeButton = container.querySelector('[data-frok-action="close"]');
    this.nextButton = container.querySelector('[data-frok-action="right"]');
    this.backButton = container.querySelector('[data-frok-action="left"]');
    this.expandButton = container.querySelector('[data-frok-action="expand"]');
    const boxElement = container.querySelector('.a-box, .a-box--modal');

    this.setActiveImage();

    // Set Up Image sequence
    if (this.nextButton instanceof HTMLElement && this.sequence) {
      this.nextButton.addEventListener('click', () => {
        this.triggerEvent('next', this.currentIndex);
      });
    }

    if (this.backButton instanceof HTMLElement && this.sequence) {
      this.backButton.addEventListener('click', () => {
        this.triggerEvent('back', this.currentIndex);
      });
    }

    // close Button
    if (this.closeButton instanceof HTMLElement) {
      this.closeButton.addEventListener('click', () => {
        this.triggerEvent('closeClicked');
      });
    }

    // expand button for long captions
    if (this.expandButton instanceof HTMLElement && this.extended) {
      this.expandButton.addEventListener('click', () => {
        this.toggleCaption();
        this.toggleExpandButton();
      })
    }

    if (boxElement) {
      this.box = new Box(boxElement as HTMLElement);

      if (this.box.isModal()) {
        // move to the end as well
        document.body.appendChild(container);
        // and move the box back into here
        container.appendChild(boxElement);
      }

      this.wrapper.addEventListener('click', event => {
        if (event.target === this.wrapper) {
          this.triggerEvent('backgroundClicked');
        }
      });

    } else {
      throw new Error(
        'Dialog is missing a box, please check your dialog markup',
      );
    }
  }

  /**
   * @name next
   * @param {number} index current index
   *
   * set new currentIndex
   * resets caption & expandButton
   * set new active image
   * check if changes related to the captions length is needed
   */
  public next = (index: number): void => {
    if (index + 1 !== this.images.length) {
      this.currentIndex = index + 1;
    }
    
    this.toggleCaption(true);
    this.toggleExpandButton(true);
    this.setActiveImage();
    this.setLongCaptionClass();
  };
  
  /**
   * @name back
   * @param {number} index current index
   *
   * set new currentIndex
   * resets caption & expandButton
   * set new active image
   * check if changes related to the captions length is needed
   */
  public back = (index: number): void => {
    if (index !== 0) {
      this.currentIndex = index - 1;
    }

    this.toggleCaption(true);
    this.toggleExpandButton(true);
    this.setActiveImage();
    this.setLongCaptionClass();
  };

  /**
   * @name show
   * shows this dialog
   */
  public show(): void {
    this.box.show();
    this.isOpen = true;
    
    this.setLongCaptionClass();
  }

  /**
   * @name hide
   * hides this dialog
   * set inner state
   * reset caption & long caption class & expand button
   * reset currentIndex to 0
   * set active image 
   */
  public hide(): void {
    this.box.hide();
    this.isOpen = false;

    this.container.classList.remove(LONG_CAPTION_CLASS);
    this.toggleCaption(true);
    this.toggleExpandButton(true);

    this.currentIndex = 0;
    this.setActiveImage();
  }

  /**
   * @name isCaptionToLong
   * Checks the sizes of the image caption
   * 
   * @return true if the text needs to be expandable
   */
  private isCaptionToLong(): boolean {
    const imageCaption = this.images[this.currentIndex].querySelector(
      'figcaption',
    );
    let result: boolean;

    if (this.isMobile) {
      /**
       * only on mobil the check is different, because the controls need to visible 
       * compared to tablet and bigger viewport
       * check if the scrollHeight of the caption is bigger or equal to
       * height of the wrapper - header hight (48) - footer height (48) - the image-size
       * 
       */
      result = imageCaption.scrollHeight >= this.wrapper.clientHeight - 48 - 48 - this.images[this.currentIndex].clientHeight;
    } else {
      result = imageCaption.clientHeight < imageCaption.scrollHeight;
    }

    return result;
  }

  /**
   * @name toggleCaption
   * @param {boolean} collapse optional parameter to overwrite toggle and collapse the caption
   * 
   * expand caption to be completely visible
   * if collapse will passed, the open class will be removed
   */
  private toggleCaption(collapse?: boolean): void {
    const imageCaption = this.images[this.currentIndex].querySelector(
      'figcaption',
    );

    if (imageCaption instanceof HTMLElement) {
      imageCaption.classList.contains(FIGCAPTION_OPEN_CLASS)
        ? imageCaption.classList.remove(FIGCAPTION_OPEN_CLASS)
        : imageCaption.classList.add(FIGCAPTION_OPEN_CLASS)
  
      if (collapse) imageCaption.classList.remove(FIGCAPTION_OPEN_CLASS);
    }
  }

  /**
   * @name toggleExpandButton
   * @param {boolean} collapse optional parameter to overwrite toggle and collapse the expandButton
   * toggle the expand button to open / close state
   */
  private toggleExpandButton(collapse?: boolean): void {
    if (this.expandButton instanceof HTMLElement) {
      this.expandButton.classList.contains(FIGCAPTION_OPEN_CLASS)
        ? this.expandButton.classList.remove(FIGCAPTION_OPEN_CLASS)
        : this.expandButton.classList.add(FIGCAPTION_OPEN_CLASS)
  
      if (collapse) this.expandButton.classList.remove(FIGCAPTION_OPEN_CLASS);
    }
  }

  /**
   * @name setLongCaptionClass
   *
   * set -long-caption class on lightbox if caption is to long
   */
  private setLongCaptionClass(): void {
    if (this.extended && this.isCaptionToLong()) {
      this.container.classList.add(LONG_CAPTION_CLASS);
    } else if (this.extended && !this.isCaptionToLong()) {
      this.container.classList.remove(LONG_CAPTION_CLASS);
    }
  }

  /**
   * @name setActiveImage
   * 
   * sets the new active image, related to current index
   * update counter
   */
  private setActiveImage(): void {
    this.images.forEach((image, index) => {
      if (index === this.currentIndex) {
        image.classList.add(IMAGE_ACTIVE_CLASS);
      } else {
        image.classList.remove(IMAGE_ACTIVE_CLASS);
      };
    })

    if (this.counter instanceof HTMLElement) {
      this.counter.innerHTML = `${this.currentIndex + 1} / ${this.images.length}`;
    }
  }
}

export default Lightbox;
