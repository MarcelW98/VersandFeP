import BaseComponent from '../../baseComponent';

/**
 * @name closeAll
 * @description
 * close all of the listed entries
 */
const closeAll = (navigationEntries: HTMLElement[]) => {
  navigationEntries.forEach((entry: HTMLElement): void => {
    entry.parentElement.classList.remove('-open');
  });
};

/**
 * @name handleOpeningTransitionEnd
 * @param {HTMLElement} container     the element which should receive the transitionend eventHandler
 * @description
 * function will add transitionend eventHandler to received element
 * handler function will be attached
 * handler function itself will detach itself form element after transitionend
 */
const handleOpeningTransitionEnd = (container: HTMLElement): void => {
  const handler = () => {
    container.classList.add('-open');
    container.classList.remove('-opening');

    container.removeEventListener('transitionend', handler);
  };

  container.addEventListener('transitionend', handler);
};

export default class SideNavigation extends BaseComponent {
  private sideMenuTriggerOpen: HTMLButtonElement;
  private sideMenuTriggerClose: HTMLButtonElement;
  private menuItems: HTMLButtonElement[];
  private triggerItems: HTMLElement[];

  /**
   * @name show
   * @description
   * function to open the side navigation with an external trigger
   */
  public show(): void {
    if (
      !this.container.classList.contains('-open') &&
      !this.container.classList.contains('-opening')
    ) {
      handleOpeningTransitionEnd(this.container);
      this.container.classList.add('-opening');
    }
  }

  constructor(container: HTMLElement) {
    super(container);

    if (this.alreadyInitialized === true) {
      // do not set up event handlers twice, as they will not work
      return this;
    }
    /**
     * Define DOM Elements and Variables
     */
    this.sideMenuTriggerOpen = container.querySelector(
      '.m-side-navigation__header__trigger.-open',
    );

    this.sideMenuTriggerClose = container.querySelector(
      '.m-side-navigation__header__trigger.-close',
    );

    this.menuItems = Array.from(
      container.querySelectorAll('.m-side-navigation__menuItem'),
    );

    this.triggerItems = Array.from(
      container.querySelectorAll('.m-side-navigation__menuItem button'),
    );

    /**
     * Define Events
     */
    // Click the burger icon's button and open the side navigation
    // Make the burger icon's accessible
    this.sideMenuTriggerOpen.addEventListener('click', () => {
      container.classList.add('-opening');
      handleOpeningTransitionEnd(this.container);
      this.sideMenuTriggerOpen.setAttribute('tabindex', '-1');
      this.sideMenuTriggerClose.setAttribute('tabindex', '0');
    });

    // Click the close icon's button and close the side navigation
    // Make the burger icon's no longer accessible
    // Close all the open subitems
    this.sideMenuTriggerClose.addEventListener('click', () => {
      container.classList.remove('-open');
      container.classList.remove('-opening');
      // this.container.removeEventListener('transitionend');
      this.sideMenuTriggerOpen.setAttribute('tabindex', '0');
      this.sideMenuTriggerClose.setAttribute('tabindex', '-1');
      closeAll(this.triggerItems);
    });

    // Click the icons and open the side navigation
    // Once the navigation is open make those items clickable
    this.menuItems.forEach((menuItem) => {
      menuItem.addEventListener('click', (event) => {
        if (!container.classList.contains('-open')) {
          event.preventDefault();
        }
        container.classList.add('-open');
      });
    });

    this.triggerItems.forEach((button) => {
      // Click a group item
      button.addEventListener('click', () => {
        // if the accordion is open, close it
        if (container.classList.contains('-open')) {
          if (button.parentElement.classList.contains('-open')) {
            button.parentElement.classList.remove('-open');
            button.parentElement
              .querySelectorAll('a:not(.-disabled')
              .forEach((link) => link.setAttribute('tabIndex', '-1'));
          } else {
            // Close all menus
            closeAll(this.triggerItems);
            // Open the menu that was clicked
            button.parentElement.classList.add('-open');
            button.parentElement
              .querySelectorAll('a:not(.-disabled')
              .forEach((link) => link.removeAttribute('tabIndex'));
          }
        }
      });
    });
  }
}
