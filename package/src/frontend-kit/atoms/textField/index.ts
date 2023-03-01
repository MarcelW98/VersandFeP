import BaseComponent from '../../baseComponent';

const TOGGLE_ICON = '.a-text-field__icon-password';
const PASSWORD_VISIBLE_CLASS = '-password-visible';
const PASSWORD_INVISIBLE_ICON = 'ui-ic-watch-on';
const PASSWORD_VISIBLE_ICON = 'ui-ic-watch-off';

export default class TextField extends BaseComponent {
  protected static events = ['onClick'];

  private toggleIcon: HTMLElement;

  private input: HTMLElement;

  constructor(container: HTMLElement) {
    super(container);

    /**
     * Define DOM Elements and Variables
     */
    this.toggleIcon = container.querySelector(TOGGLE_ICON);
    this.input = container.querySelector('input');

    // register change event for the select
    if (this.toggleIcon instanceof HTMLElement) {
      this.toggleIcon.addEventListener('click', () => {
        const { input } = this;
        const icon = this.toggleIcon.querySelector('.a-icon');

        icon.classList.remove(PASSWORD_VISIBLE_ICON, PASSWORD_INVISIBLE_ICON);
        if (input.getAttribute('type') === 'password') {
          container.classList.add(PASSWORD_VISIBLE_CLASS);
          input.setAttribute('type', 'text');
          icon.classList.add(PASSWORD_VISIBLE_ICON);
        } else {
          container.classList.remove(PASSWORD_VISIBLE_CLASS);
          input.setAttribute('type', 'password');
          icon.classList.add(PASSWORD_INVISIBLE_ICON);
        }
      });
    }
  }
}
