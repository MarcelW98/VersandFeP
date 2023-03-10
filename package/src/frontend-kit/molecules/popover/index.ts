import BaseComponent from '../../baseComponent';

import { ArrowPosition, arrowClasses } from './constants';

const SHOW_CLASS = '-show';
const DETACHED_CLASS = '-detached';

interface Offset {
  left: number;
  top: number;
}
interface StringOffset {
  left: string;
  top: string;
}

const getPositionClientRect = (element: HTMLElement): ClientRect => {
  const clientRect = element.getBoundingClientRect();

  return {
    ...clientRect,
    left: clientRect.left + window.pageXOffset,
    top: clientRect.top + window.pageYOffset,
    bottom: clientRect.bottom + window.pageYOffset,
    right: clientRect.right + window.pageXOffset,
  };
};

const getTargetOffsetForPositionAndArrowClass = (
  position: ClientRect,
  arrowClass: string,
): Offset => {
  switch (arrowClass) {
    case ArrowPosition.RIGHT_CENTER:
    case ArrowPosition.RIGHT_TOP:
    case ArrowPosition.RIGHT_BOTTOM:
      return {
        left: position.left,
        top: position.top + (position.bottom - position.top) / 2,
      };
    case ArrowPosition.LEFT_CENTER:
    case ArrowPosition.LEFT_TOP:
    case ArrowPosition.LEFT_BOTTOM:
      return {
        left: position.right,
        top: position.top + (position.bottom - position.top) / 2,
      };
    case ArrowPosition.BOTTOM_CENTER:
    case ArrowPosition.BOTTOM_LEFT:
    case ArrowPosition.BOTTOM_RIGHT:
      return {
        left: position.left + (position.right - position.left) / 2,
        top: position.top,
      };
    case ArrowPosition.TOP_CENTER:
    case ArrowPosition.TOP_LEFT:
    case ArrowPosition.TOP_RIGHT:
    default:
      return {
        left: position.left + (position.right - position.left) / 2,
        top: position.bottom,
      };
  }
};

const getPositionOffsetForDimensionAndArrowClass = (
  dimension: ClientRect,
  arrowClass: string,
): Offset => {
  const left = ((): number => {
    switch (arrowClass) {
      case ArrowPosition.BOTTOM_RIGHT:
      case ArrowPosition.TOP_RIGHT:
      case ArrowPosition.RIGHT_TOP:
      case ArrowPosition.RIGHT_CENTER:
      case ArrowPosition.RIGHT_BOTTOM:
        return dimension.right - dimension.left;
      case ArrowPosition.BOTTOM_LEFT:
      case ArrowPosition.TOP_LEFT:
      case ArrowPosition.LEFT_TOP:
      case ArrowPosition.LEFT_CENTER:
      case ArrowPosition.LEFT_BOTTOM:
        return 0;
      case ArrowPosition.BOTTOM_CENTER:
      case ArrowPosition.TOP_CENTER:
      default:
        return (dimension.right - dimension.left) / 2;
    }
  })();

  const top = ((): number => {
    switch (arrowClass) {
      case ArrowPosition.LEFT_CENTER:
      case ArrowPosition.RIGHT_CENTER:
        return (dimension.bottom - dimension.top) / 2;
      case ArrowPosition.LEFT_BOTTOM:
      case ArrowPosition.RIGHT_BOTTOM:
      case ArrowPosition.BOTTOM_LEFT:
      case ArrowPosition.BOTTOM_RIGHT:
      case ArrowPosition.BOTTOM_CENTER:
        return dimension.bottom - dimension.top;
      case ArrowPosition.LEFT_TOP:
      case ArrowPosition.RIGHT_TOP:
      case ArrowPosition.TOP_LEFT:
      case ArrowPosition.TOP_RIGHT:
      case ArrowPosition.TOP_CENTER:
      default:
        return 0;
    }
  })();

  return { left, top };
};

const getStaticOffsetForArrowClass = (arrowClass: string): StringOffset => {
  const left = ((): string => {
    switch (arrowClass) {
      case ArrowPosition.RIGHT_TOP:
      case ArrowPosition.RIGHT_CENTER:
      case ArrowPosition.RIGHT_BOTTOM:
        return '- 1rem';
      case ArrowPosition.LEFT_TOP:
      case ArrowPosition.LEFT_CENTER:
      case ArrowPosition.LEFT_BOTTOM:
        return '+ 1rem';
      case ArrowPosition.TOP_RIGHT:
      case ArrowPosition.BOTTOM_RIGHT:
        return '+ 24px';
      case ArrowPosition.TOP_LEFT:
      case ArrowPosition.BOTTOM_LEFT:
        return '- 24px';
      case ArrowPosition.TOP_CENTER:
      case ArrowPosition.BOTTOM_CENTER:
      default:
        return '0';
    }
  })();

  const top = ((): string => {
    switch (arrowClass) {
      case ArrowPosition.RIGHT_TOP:
      case ArrowPosition.LEFT_TOP:
        return '- 24px';
      case ArrowPosition.RIGHT_CENTER:
      case ArrowPosition.LEFT_CENTER:
        return '0';
      case ArrowPosition.RIGHT_BOTTOM:
      case ArrowPosition.LEFT_BOTTOM:
        return '+ 24px';
      case ArrowPosition.BOTTOM_RIGHT:
      case ArrowPosition.BOTTOM_CENTER:
      case ArrowPosition.BOTTOM_LEFT:
        return '- 1rem';
      case ArrowPosition.TOP_RIGHT:
      case ArrowPosition.TOP_CENTER:
      case ArrowPosition.TOP_LEFT:
      default:
        return '+ 1rem';
    }
  })();

  return { left, top };
};

const getArrowClass = (element: HTMLElement): string => {
  const candidates = arrowClasses.filter((className) =>
    element.classList.contains(className),
  );

  if (candidates.length === 0) {
    return 'top-center';
  }

  return candidates[0].substring(1);
};

class Popover extends BaseComponent {
  private static events = ['buttonClicked', 'closeButtonClicked'];
  private attachedTo: HTMLElement | null;
  private attachmentContainer: HTMLElement | null;

  constructor(container: HTMLElement) {
    super(container);

    const closeButton = container.querySelector('.a-button--integrated');
    const button = container.querySelector(
      '.a-button:not(.a-button--integrated)',
    );

    if (button) {
      button.addEventListener('click', () =>
        this.triggerEvent('buttonClicked'),
      );
    }

    if (closeButton) {
      closeButton.addEventListener('click', () =>
        this.triggerEvent('closeButtonClicked'),
      );
    }

    // If window resizes hide the popover
    window.addEventListener('resize', () => this.hide());
  }

  /**
   * Attach the popover to the given target element, moving it's position so
   * the popover's arrow is pointing at the target
   *
   * @param target          an element to attach to
   * @param moveToContainer also, move the popoever element to be a child of this
   *                        container, defaults to document.body.
   *                        NOTE: if you do not want to have the popover leave your
   *                        structure, supply a container with
   *                        `position: relative`here.
   */
  public attach(
    target: HTMLElement,
    moveToContainer: HTMLElement = document.body,
  ): Popover {
    moveToContainer.appendChild(this.container);
    this.container.classList.remove(DETACHED_CLASS);

    this.attachedTo = target;
    this.attachmentContainer = moveToContainer;

    this.recalculatePosition();

    return this;
  }

  private recalculatePosition(): void {
    if (!this.attachedTo) {
      return;
    }
    const targetRect = getPositionClientRect(this.attachedTo);

    const arrowClass = getArrowClass(this.container);

    this.container.style.left = '-9999px';
    this.container.style.display = 'block';

    const dimensions = this.container.getBoundingClientRect();

    const containerOffset = getPositionClientRect(this.attachmentContainer);

    const targetOffset = getTargetOffsetForPositionAndArrowClass(
      targetRect,
      arrowClass,
    );

    const positionOffset = getPositionOffsetForDimensionAndArrowClass(
      dimensions,
      arrowClass,
    );

    const staticOffset = getStaticOffsetForArrowClass(arrowClass);

    const leftPixels = `${
      targetOffset.left - containerOffset.left - positionOffset.left
    }px`;
    const leftStyle =
      staticOffset.left === '0'
        ? leftPixels
        : `calc(${leftPixels} ${staticOffset.left})`;

    this.container.style.left = leftStyle;

    const topPixels = `${
      targetOffset.top - containerOffset.top - positionOffset.top
    }px`;
    const topStyle =
      staticOffset.top === '0'
        ? topPixels
        : `calc(${topPixels} ${staticOffset.top})`;

    this.container.style.top = topStyle;

    this.container.style.display = '';
  }

  public show(): void {
    this.recalculatePosition();
    this.container.classList.add(SHOW_CLASS);
  }

  public hide(): void {
    this.container.classList.remove(SHOW_CLASS);
  }

  public setPosition(position: ArrowPosition): void {
    this.container.classList.remove(`-${getArrowClass(this.container)}`);
    this.container.classList.add(`-${position}`);
    this.recalculatePosition();
  }
}

export default Popover;
