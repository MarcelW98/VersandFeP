import BaseComponent from '../../baseComponent';
import ElementWithComponent from '../../ElementWithComponent';
import Popover from '../../molecules/popover';
import { ArrowPosition } from '../../molecules/popover/constants';

/**
 * closes the given menu entry
 */
const close = (entry: Element): void => {
  entry.parentElement.classList.remove('-open');
};

/**
 * close all of the listed entries
 */
const closeAll = (navigationEntries: HTMLElement[]): void => {
  navigationEntries.forEach(close);
};

export default class ContextMenu extends BaseComponent {
  private accordions: HTMLButtonElement[];
  private menus: HTMLUListElement[];
  private contextMenuTriggerOpen: HTMLButtonElement;
  private contextMenuTriggerClose: HTMLButtonElement;
  private popoverElement: ElementWithComponent<Popover>;
  private popover: Popover;

  constructor(container: HTMLElement) {
    super(container);

    this.contextMenuTriggerOpen = container.querySelector(
      '.o-context-menu__trigger[data-frok-action="open"]',
    );

    this.contextMenuTriggerClose = container.querySelector(
      '.o-context-menu__trigger[data-frok-action="close"]',
    );

    this.accordions = Array.from(
      container.querySelectorAll('.a-menu-item__group'),
    );

    this.menus = Array.from(container.querySelectorAll('.a-menu-item'));

    this.popoverElement = container.querySelector('.m-popover');
    this.popover = new Popover(this.popoverElement);

    /**
     * Define Events
     */

    // The button logic: Clicking it will show the context menu, clicking again will hide it again.
    if (this.contextMenuTriggerOpen || this.contextMenuTriggerClose) {
      this.contextMenuTriggerOpen.addEventListener('click', () => {
        this.open();
      });

      this.contextMenuTriggerClose.addEventListener('click', () => {
        this.close();
      });
    }

    // The accordion logic: If I click an accordion it'll open while closing previously opened accordions.
    // If I click again it'll closes the accordion.
    this.accordions.forEach((accordion) => {
      accordion.addEventListener('click', () => {
        if (accordion.parentElement.classList.contains('-open')) {
          accordion.parentElement.classList.remove('-open');
        } else {
          closeAll(this.accordions);
          accordion.parentElement.classList.add('-open');
        }
      });
    });

    document.addEventListener('click', (event) => {
      if (!event.composedPath().includes(this.container)) {
        this.close();
      }
    });
  }

  public open(): void {
    this.container.classList.add('-open');
    this.popover.attach(this.contextMenuTriggerClose, this.container);
    this.popover.show();
  }

  public close(): void {
    this.container.classList.remove('-open');
    this.popover.hide();
    closeAll(this.accordions);
    closeAll(this.menus);
  }

  public setPosition(position: ArrowPosition): void {
    this.popover.setPosition(position);
  }
}
