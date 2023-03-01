import BaseComponent from '../../baseComponent';

/**
 * returns the entry for the given trigger
 */
const entryFor = (trigger: Element): Element => trigger.parentElement;

/**
 * returns the menu for the given entry
 */
const menuFor = (entry: Element): Element =>
  Array.from(entry.children).find((child) =>
    child.classList.contains('o-header__navigation-sub-level'),
  );

/**
 * returns the trigger for the given entry
 */
const triggerFor = (entry: Element): Element =>
  Array.from(entry.children).find((child) =>
    child.classList.contains('o-header__navigation-trigger'),
  );

/**
 * set the given tabindex for all "direct-descendant" buttons and links in the given menu
 */
const sebTabIndexForButtonsAndLinks = (
  menu: Element,
  tabIndex: number,
): void => {
  const secondLevelChildren = Array.from(menu.children)
    .map((child) => Array.from(child.children))
    .reduce((flat, list) => flat.concat(list));

  const triggers = secondLevelChildren.filter((child) =>
    child.classList.contains('o-header__navigation-trigger'),
  );

  triggers.forEach((trigger) => {
    const tabbableElement =
      trigger.tagName === 'button' ? trigger : trigger.children.item(0);

    tabbableElement.setAttribute('tabindex', tabIndex.toString(10));
  });
};

/**
 * closes the given menu entry - only handles DOM state updates
 */
const close = (entry: Element): void => {
  const associatedMenu = menuFor(entry);
  if (!associatedMenu) {
    // entries without any submenu do not need handling;
    return;
  }
  entry.classList.remove('-open');
  triggerFor(entry).setAttribute('aria-expanded', 'false');
  associatedMenu.setAttribute('aria-hidden', 'true');
  sebTabIndexForButtonsAndLinks(associatedMenu, -1);
};

/**
 * opens the given menu entry - only handles DOM state updates
 */
const open = (entry: Element): void => {
  const associatedMenu = menuFor(entry);
  if (!associatedMenu) {
    // entries without any submenu do not need handling;
    return;
  }
  entry.classList.add('-open');
  triggerFor(entry).setAttribute('aria-expanded', 'true');
  menuFor(entry).setAttribute('aria-hidden', 'false');
  sebTabIndexForButtonsAndLinks(associatedMenu, 0);
};

const setSearchFormState = (
  form: HTMLElement,
  trigger: Element,
  closer: Element,
  enabled: boolean,
): void => {
  form.setAttribute('aria-hidden', enabled ? 'false' : 'true');
  /* eslint-disable-next-line no-param-reassign */
  form.style.display = enabled ? 'inline-block' : 'none';

  const searchFormControls = Array.from(form.children[0].children).filter(
    (child) => {
      return (
        child.tagName.toLowerCase() === 'button' ||
        child.tagName.toLowerCase() === 'input'
      );
    },
  );

  searchFormControls.forEach((control) =>
    control.setAttribute('tabindex', enabled ? '0' : '-1'),
  );

  trigger.setAttribute('aria-expanded', enabled ? 'true' : 'false');
  trigger.setAttribute('tabindex', enabled ? '-1' : '0');
  closer.setAttribute('tabindex', enabled ? '0' : '-1');
};

const enableSearchForm = (
  form: HTMLElement,
  trigger: Element,
  closer: Element,
): void => setSearchFormState(form, trigger, closer, true);

const disableSearchForm = (
  form: HTMLElement,
  trigger: Element,
  closer: Element,
): void => setSearchFormState(form, trigger, closer, false);

/**
 * close all of the listed entries
 */
const closeAll = (navigationEntries: HTMLElement[]): void => {
  navigationEntries.forEach(close);
};

export default class Header extends BaseComponent {
  private menuTrigger: HTMLButtonElement;
  private searchTrigger: HTMLButtonElement;
  private searchCloseTrigger: HTMLButtonElement;
  private searchForm: HTMLElement;
  private searchInput: HTMLInputElement;
  private pageMarginContainer: HTMLDivElement;
  private navigationTriggers: HTMLButtonElement[];
  private navigationCloseTriggers: HTMLButtonElement[];
  private firstLevelNavigationEntries: HTMLLIElement[];
  private secondLevelNavigationEntries: HTMLLIElement[];

  constructor(container: HTMLElement) {
    super(container);

    /**
     * Define DOM Elements and Variables
     */
    this.menuTrigger = container.querySelector('.o-header__menu-trigger');

    this.searchTrigger = container.querySelector('.o-header__search-open');
    this.searchCloseTrigger = container.querySelector(
      '.o-header__search .m-search-form .a-text-field__icon-close',
    );

    this.searchForm = container.querySelector(
      '.o-header__search .m-search-form',
    );

    this.searchInput = this.searchForm.querySelector('input');

    this.pageMarginContainer = container.querySelector('.e-container');

    this.navigationTriggers = Array.from(
      container.querySelectorAll('button.o-header__navigation-trigger'),
    );

    this.navigationCloseTriggers = Array.from(
      container.querySelectorAll('button.o-header__navigation-close-trigger'),
    );

    this.firstLevelNavigationEntries = Array.from(
      container.querySelectorAll('.o-header__navigation-first-level-item'),
    );

    this.secondLevelNavigationEntries = Array.from(
      container.querySelectorAll(
        '.o-header__navigation-first-level-item > ul > .o-header__navigation-sub-level-item',
      ),
    );

    this.menuTrigger.addEventListener('click', () => {
      container.classList.toggle('-menu-open');
      closeAll(this.firstLevelNavigationEntries);
      closeAll(this.secondLevelNavigationEntries);
      container.classList.remove('-second-level-open');
      container.classList.remove('-third-level-open');
      container.classList.remove('-search-open');
      disableSearchForm(
        this.searchForm,
        this.searchTrigger,
        this.searchCloseTrigger,
      );
    });

    this.searchTrigger.addEventListener('click', () => {
      container.classList.add('-search-open');
      container.classList.remove('-menu-open');
      this.adjustSeachFieldWidth();
      enableSearchForm(
        this.searchForm,
        this.searchTrigger,
        this.searchCloseTrigger,
      );
      this.searchInput.focus();
    });

    this.searchCloseTrigger.addEventListener('click', () => {
      container.classList.remove('-search-open');
      this.adjustSeachFieldWidth();
      disableSearchForm(
        this.searchForm,
        this.searchTrigger,
        this.searchCloseTrigger,
      );
    });

    // disable the form when initializing
    disableSearchForm(
      this.searchForm,
      this.searchTrigger,
      this.searchCloseTrigger,
    );

    /**
     * hide search form properly after initializing
     * we need to do this afterwards and out of CSS
     * to be able to attach eventListener on the element
     */
    this.searchForm.style.display = 'none';

    window.addEventListener('resize', () => this.adjustSeachFieldWidth());

    this.navigationTriggers.forEach((trigger) => {
      const associatedEntry = entryFor(trigger);
      const isOnFirstLevel = trigger.parentElement.classList.contains(
        'o-header__navigation-first-level-item',
      );
      trigger.addEventListener('click', () => {
        associatedEntry.parentElement.scrollTop = 0;
        closeAll(this.secondLevelNavigationEntries);
        if (isOnFirstLevel) {
          closeAll(this.firstLevelNavigationEntries);
          container.classList.add('-second-level-open');
          container.classList.remove('-third-level-open');
        } else {
          container.classList.remove('-second-level-open');
          container.classList.add('-third-level-open');
        }
        open(associatedEntry);
      });
    });

    this.navigationCloseTriggers.forEach((trigger) => {
      const associatedEntry = trigger.parentElement.parentElement;
      const isOnFirstLevel = associatedEntry.classList.contains(
        'o-header__navigation-first-level-item',
      );
      trigger.addEventListener('click', () => {
        container.classList.remove('-third-level-open');
        if (!isOnFirstLevel) {
          container.classList.add('-second-level-open');
        } else {
          container.classList.remove('-second-level-open');
        }

        close(associatedEntry);
      });
    });
  }

  private adjustSeachFieldWidth(): void {
    if (this.container.classList.contains('-search-open')) {
      const menuTriggerWidth = this.menuTrigger.offsetWidth;
      const containerWIdth = this.pageMarginContainer.offsetWidth;
      // some 16px are still missing from the width - I don't know where, but let's add them here
      this.searchForm.style.width = `calc(${
        containerWIdth - menuTriggerWidth
      }px + 1rem)`;
    } else {
      this.searchForm.style.width = '0px';
    }
  }
}
