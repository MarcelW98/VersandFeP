import BaseComponent from '../../baseComponent';
import ElementWithComponent from '../../ElementWithComponent';
import Box from '../../atoms/box';

class Dialog extends BaseComponent {
  protected static events = [
    'confirmed',
    'canceled',
    'backgroundClicked',
    'closeClicked',
  ];

  /**
   * returns a valid dialog ID to place into the modal box for the given string
   */
  public static dialogId = (id: string): string => `frontend-kit-dialog-${id}`;

  /**
   * finds a dialog by the given dialog ID
   */
  public static findDialog = (
    id: string,
    getElementByID: typeof window.document.getElementById = (id: string) => window.document.getElementById(Dialog.dialogId(id))
  ): ElementWithComponent<Box> | null => {

    return getElementByID(id) as ElementWithComponent<Box>;
  }

  /**
   * shows the modal with the given modal ID, if it exists
   */
  public static showDialog = (id: string): void => {
    const dialogElement = Dialog.findDialog(id);

    if (!dialogElement) {
      console.warn(`Could not find a dialog with id ${id} to show.`);
    } else {
      dialogElement.component.show();
    }
  };

  /**
   * hides the modal with the given modal ID, if it exists
   */
  public static hideDialog = (id: string): void => {
    const dialogElement = Dialog.findDialog(id);

    if (!dialogElement) {
      console.warn(`Could not find a dialog with id ${id} to hide.`);
    } else {
      dialogElement.component.hide();
    }
  };

  /**
   * the underlying box component
   */
  private box: Box;

  constructor(container: HTMLElement) {
    super(container);

    // setup event buttons as event triggers
    const confirmButton = container.querySelector(
      '[data-frok-action="confirm"]',
    );
    if (confirmButton instanceof Element) {
      confirmButton.addEventListener('click', () => {
        this.triggerEvent('confirmed');
      });
    }

    const cancelButton = container.querySelector('[data-frok-action="cancel"]');
    if (cancelButton instanceof Element) {
      cancelButton.addEventListener('click', () => {
        this.triggerEvent('canceled');
      });
    }

    const closeButton = container.querySelector('[data-frok-action="close"]');
    if (closeButton instanceof Element) {
      closeButton.addEventListener('click', () => {
        this.triggerEvent('closeClicked');
      });
    }

    // setup box sub-component
    const boxElement = container.querySelector('.a-box, .a-box--modal');

    if (boxElement) {
      this.box = new Box(boxElement as HTMLElement);

      if (this.box.isModal()) {
        // move to the end as well
        document.body.appendChild(container);
        // and move the box back into here
        container.appendChild(boxElement);
      }

      this.box.addEventListener('backgroundClicked', () =>
        this.triggerEvent('backgroundClicked'),
      );
    } else {
      throw new Error(
        'Dialog is missing a box, please check your dialog markup',
      );
    }
  }

  /**
   * shows this dialog
   */
  public show(): void {
    this.box.show();
  }

  /**
   * hides this dialog
   */
  public hide(): void {
    this.box.hide();
  }
}

export default Dialog;
