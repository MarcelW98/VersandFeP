import BaseComponent from '../../baseComponent';

const TAB_SELECTED_CLASS = `-selected`;
const TAB_DISABLED_CLASS = `-disabled`;

export default class TabNavigation extends BaseComponent {
  protected static events = ['selected'];

  private readonly tabs: NodeList;

  constructor(container: HTMLElement) {
    super(container);

    /**
     * Define DOM Elements and Variables
     */
    this.tabs = container.querySelectorAll('.a-tab-navigation__tab');

    Array.from(this.tabs).forEach(tab => {
      if (tab instanceof HTMLElement) {
        tab.addEventListener('click', () => {
          if (
            !tab.classList.contains(TAB_SELECTED_CLASS) &&
            !tab.classList.contains(TAB_DISABLED_CLASS)
          ) {
            this.deselectAllTabs();
            tab.classList.add(TAB_SELECTED_CLASS);
            tab.setAttribute('aria-pressed', 'true');
            this.triggerEvent('selected', tab.dataset.frokTabIdentifier);
          }
        });
      }
    });
  }

  private deselectAllTabs(): void {
    Array.from(this.tabs).forEach(tab => {
      if (tab instanceof HTMLElement) {
        tab.classList.remove(TAB_SELECTED_CLASS);
        tab.removeAttribute('aria-pressed');
      }
    });
  }
}
