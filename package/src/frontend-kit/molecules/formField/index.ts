import BaseComponent from '../../baseComponent';

enum State {
  success = 'success',
  error = 'error',
  warning = 'warning',
  neutral = 'neutral',
}

const states = [State.success, State.error, State.warning, State.neutral];

// from https://stackoverflow.com/questions/494143/creating-a-new-dom-element-from-an-html-string-using-built-in-dom-methods-or-pro
const createElementFromHTML = (htmlString: string): Node => {
  const div = document.createElement('div');
  div.innerHTML = htmlString.trim();

  return div.firstChild;
};

const createNotificationTemplate = (content: string, level: State): string => `
    <div class="a-notification a-notification--text -${level || 'neutral'}">
        ${
          level &&
          `<i class="a-icon ui-ic-alert-${level}" title="Loren Ipsum"></i>`
        }
        <div class="a-notification__content">
            ${content}
        </div>
    </div>
`;

class FormField extends BaseComponent {
  private notification: HTMLElement;

  private field: HTMLElement;

  private input: HTMLInputElement;

  constructor(container: HTMLElement) {
    super(container);

    this.field = container.querySelector(
      '.a-text-field, .a-text-area, .a-radio-button, .a-checkbox, .a-dropdown, .a-toggle',
    );

    this.input = this.field.querySelector('input, textarea');
  }

  public setState(state: string, notification?: string): void {
    if (!states.includes(state as State)) {
      console.warn(`Unknown state ${state} for a FormField - ignoring.`);
      return;
    }
    states.forEach((stateEntry) =>
      this.field.classList.remove(`-${stateEntry}`),
    );
    this.field.classList.add(`-${state}`);
    if (notification) {
      this.setNotification(notification);
    } else {
      this.clearNotification();
    }
  }

  private clearNotification(): void {
    if (this.notification) {
      this.notification.remove();
    }
  }

  private setNotification(content: string): void {
    this.clearNotification();

    this.notification = createElementFromHTML(
      createNotificationTemplate(content, this.getState()),
    ) as HTMLElement;

    this.container.appendChild(this.notification);
  }

  private getState(): State {
    const candidates = states.filter((state) =>
      this.field.classList.contains(`-${state}`),
    );

    if (candidates.length === 0) {
      return State.neutral;
    }
    return candidates[0];
  }
}

export default FormField;
