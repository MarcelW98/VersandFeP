import BaseComponent from '../../baseComponent';
import ElementWithComponent from '../../ElementWithComponent';
import { ArrowPosition } from '../../molecules/popover/constants';
import SideNavigation from '../../molecules/sideNavigation';
import Viewports from '../../viewports';
import ContextMenu from '../contextMenu';

export default class MinimalHeader extends BaseComponent {
  private sideNavigation: SideNavigation;
  private sideNavigationElement: ElementWithComponent<SideNavigation>;
  private burger: HTMLButtonElement;
  private contextMenuElement: ElementWithComponent<ContextMenu>;
  private contextMenu: ContextMenu;

  constructor(container: HTMLElement) {
    super(container);

    this.sideNavigationElement = container.querySelector('.m-side-navigation');
    this.contextMenuElement = container.querySelector('.o-context-menu');

    this.sideNavigation = new SideNavigation(this.sideNavigationElement);
    this.contextMenu = new ContextMenu(this.contextMenuElement);

    this.burger = container.querySelector('.o-minimal-header__burger button');

    this.burger.addEventListener('click', () => this.sideNavigation.show());

    this.adjustPopoverArrowPosition();
    window.addEventListener('resize', () => {
      this.adjustPopoverArrowPosition();
    });
  }

  private adjustPopoverArrowPosition() {
    if (window.matchMedia(Viewports.TABLET_AND_UP).matches) {
      this.contextMenu.setPosition(ArrowPosition.TOP_CENTER);
    } else {
      this.contextMenu.setPosition(ArrowPosition.TOP_RIGHT);
    }
  }
}
