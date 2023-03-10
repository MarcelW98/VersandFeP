import BaseComponent from '../../baseComponent';
import ElementWithComponent from '../../ElementWithComponent';

const SHOW_CLASS = '-show';
const MODAL_CLASS = 'a-box--modal';
const BODY_UNSCROLLABLE_CLASS = '-unscrollable';

/**
 * prevent the body from scrolling
 */
const makeBodyUnscrollable = (): void => {
  document.body.classList.add(BODY_UNSCROLLABLE_CLASS);
};

/**
 * re-enable scrolling on the body
 */
const makeBodyScrollable = (): void => {
  document.body.classList.remove(BODY_UNSCROLLABLE_CLASS);
};

/**
 * Functionality of Box component
 */
class Box extends BaseComponent {
  private static events = ['backgroundClicked'];

  /**
   * returns a valid modal ID to place into the DOM for the given string
   */
  public static modalId = (id: string): string => `frontend-kit-modal-${id}`;

  /**
   * finds a modal by the given modal ID
   */
  public static findModal = (
    id: string,
    getElementByID: typeof window.document.getElementById = (id: string) => window.document.getElementById(Box.modalId(id))
  ): ElementWithComponent<Box> | null => {

    return getElementByID(id) as ElementWithComponent<Box>;
  };

  /**
   * shows the modal with the given modal ID, if it exists
   */
  public static showModal = (id: string): void => {
    const modalElement = Box.findModal(id);

    if (!modalElement) {
      console.warn(`Could not find a modal with id ${id} to show.`);
    } else {
      modalElement.component.show();
    }
  };

  /**
   * hides the modal with the given modal ID, if it exists
   */
  public static hideModal = (id: string): void => {
    const modalElement = Box.findModal(id);

    if (!modalElement) {
      console.warn(`Could not find a modal with id ${id} to hide.`);
    } else {
      modalElement.component.hide();
    }
  };

  constructor(container: HTMLElement) {
    super(container);

    if (container.classList.contains(MODAL_CLASS)) {
      // immediately move the modal to the end of the body, so the "fullscreen modal" aspect works
      document.body.appendChild(container);
    }

    container.addEventListener('click', (event: MouseEvent) => {
      if (event.target === container) {
        this.triggerEvent('backgroundClicked');
      }
    });
  }

  /**
   * shows this modal
   */
  public show(): void {
    this.container.classList.add(SHOW_CLASS);

    if (this.isModal()) {
      makeBodyUnscrollable();
    }
  }

  /**
   * hides this modal
   */
  public hide(): void {
    this.container.classList.remove(SHOW_CLASS);

    makeBodyScrollable();
  }

  /**
   * returns true if this a modal with dimmed background
   */
  public isModal(): boolean {
    return this.container.classList.contains(MODAL_CLASS);
  }
}

export default Box;
