import BaseComponent from '../../baseComponent';
import ElementWithComponent from '../../ElementWithComponent';

const BANNER_CLASS = 'a-notification--banner';
const SHOW_CLASS = '-show';

/**
 * Behavior of a banner notification
 */
class Notification extends BaseComponent {
  private static events = ['closeClicked'];

  /**
   * returns a DOM id for the given notification id
   */
  public static notificationId = (id: string): string =>
    `frontend-kit-notification-${id}`;

  /**
   * finds a notification for the given notification id
   */
  public static findNotification = (
    id: string,
    getElementByID: typeof window.document.getElementById = (id: string) => window.document.getElementById(Notification.notificationId(id))
  ): ElementWithComponent<Notification> | null => {

    return getElementByID(id) as ElementWithComponent<Notification>;
  };

  /**
   * shows the notification with the given notification id
   */
  public static showNotification = (id: string): void => {
    const notificationElement = Notification.findNotification(id);

    if (!notificationElement) {
      console.warn(`Could not find a notification with id ${id} to show`);
    } else {
      notificationElement.component.show();
    }
  };

  /**
   * hides the notification with the given notification id
   */
  public static hideNotification = (id: string): void => {
    const notificationElement = Notification.findNotification(id);

    if (!notificationElement) {
      console.warn(`Could not find a notification with id ${id} to hide`);
    } else {
      notificationElement.component.hide();
    }
  };

  constructor(container: HTMLElement) {
    super(container);

    // if this is a banner, move it to the end of the DOM to ensure that layout is correct
    if (container.classList.contains(BANNER_CLASS)) {
      document.body.appendChild(container);
    }

    /**
     * the close button
     */
    const closeButton = container.querySelector('[data-frok-action="close"]');

    if (closeButton) {
      closeButton.addEventListener('click', () => {
        this.triggerEvent('closeClicked');
      });
    }
  }

  /**
   * shows this notification
   */
  public show(): void {
    this.container.classList.add(SHOW_CLASS);
  }

  /**
   * hides this notification
   */
  public hide(): void {
    this.container.classList.remove(SHOW_CLASS);
  }
}

export default Notification;
