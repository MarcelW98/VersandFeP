import BaseComponent from '../../baseComponent';
import updateIndicatorState from './functions/updateIndicatorState';
import updatePagination from './functions/updatePagination';

const CLASS_NUMBERED = `a-page-indicator--numbered`;
const SELECTOR_INDICATOR = '.a-page-indicator__indicator';
const SELECTOR_ARROW_LEFT = '.a-page-indicator__caret.-left';
const SELECTOR_ARROW_RIGHT = '.a-page-indicator__caret.-right';
const BOUNDARY_CLASS = '-end';

export default class PageIndicator extends BaseComponent {
  protected static events = [
    'clicked',
    'nextClicked',
    'prevClicked',
    'indexChanged',
    'maxLengthChanged',
  ];

  private indicators: NodeListOf<HTMLElement>;

  private arrowLeft: HTMLElement;

  private arrowRight: HTMLElement;

  public isNumbered: boolean;

  private activeIndex: number;

  private maxLength: number;

  constructor(container: HTMLElement) {
    super(container);

    /**
     * Define DOM Elements and Variables
     */
    this.indicators = container.querySelectorAll(SELECTOR_INDICATOR);
    this.arrowLeft = container.querySelector(SELECTOR_ARROW_LEFT);
    this.arrowRight = container.querySelector(SELECTOR_ARROW_RIGHT);
    this.isNumbered = container.classList.contains(CLASS_NUMBERED);

    // update inner state to rendered props given on the DOM element
    const startIndex =
      parseInt(container.getAttribute('data-start-index'), 0) || 0;

    const maxLength =
      parseInt(container.getAttribute('data-max-length'), 0) ||
      this.indicators.length;

    this.setMaxLength(maxLength);
    this.setActiveIndex(startIndex);

    // register click events for next and prev if arrows are given
    if (this.arrowLeft instanceof HTMLElement) {
      this.arrowLeft.addEventListener('click', () => {
        this.prev();
        this.triggerEvent('prevClicked');
      });
    }

    if (this.arrowRight instanceof HTMLElement) {
      this.arrowRight.addEventListener('click', () => {
        this.next();
        this.triggerEvent('nextClicked');
      });
    }

    if (this.indicators) {
      [...this.indicators].forEach((indicator) => {
        indicator.addEventListener('click', () => {
          const clickedIndex = parseInt(
            indicator.getAttribute('data-index'),
            0,
          );

          this.setActiveIndex(clickedIndex);
          this.triggerEvent('clicked', clickedIndex);
        });
      });
    }
  }

  public setActiveIndex(newIndex: number): number {
    if (newIndex > 0 && newIndex <= this.maxLength) {
      this.activeIndex = newIndex;

      if (this.isNumbered) {
        updatePagination(this.activeIndex, this.maxLength, this.indicators);
        this.updateArrowStyle();
      }

      updateIndicatorState(this.indicators, this.activeIndex);

      this.triggerEvent('indexChanged', newIndex);
    }

    /** @TODO don't be optimistic */
    return this.activeIndex;
  }

  public setMaxLength(length: number): number {
    this.maxLength = length;
    this.triggerEvent('maxLengthChanged', this.maxLength);

    return this.maxLength;
  }

  /**
   * @name   prev
   * @author Experience One AG
   * @copyright Robert Bosch GmbH
   *
   * @param amount  Optional: Amount to Move. (Default: 1)
   * @returns New Active Index
   * @description
   * Move Back the Active Index by N
   */
  public prev(amount = 1): number {
    const newIndex = this.activeIndex - amount;

    return this.setActiveIndex(newIndex);
  }

  /**
   * @name   next
   * @author Experience One AG
   * @copyright Robert Bosch GmbH
   *
   * @param amount  Optional: Amount to Move. (Default: 1)
   * @returns New Active Index
   * @description
   * Move Forth the Active Index by N
   */
  public next(amount = 1): number {
    const newIndex = this.activeIndex + amount;

    return this.setActiveIndex(newIndex);
  }

  /**
   * @name    updateArrowStyle
   * @author  Experience One AG
   * @copyright Rober Bosch GmbH
   *
   * @description
   * update the style of the arrows related to the active index
   */
  private updateArrowStyle(): void {
    if (
      this.activeIndex <= 1 &&
      !this.arrowLeft.classList.contains(BOUNDARY_CLASS)
    ) {
      this.arrowLeft.classList.add(BOUNDARY_CLASS);
      this.arrowRight.classList.remove(BOUNDARY_CLASS);
    } else if (
      this.activeIndex >= this.maxLength &&
      !this.arrowRight.classList.contains(BOUNDARY_CLASS)
    ) {
      this.arrowRight.classList.add(BOUNDARY_CLASS);
      this.arrowLeft.classList.remove(BOUNDARY_CLASS);
    } else {
      this.arrowLeft.classList.remove(BOUNDARY_CLASS);
      this.arrowRight.classList.remove(BOUNDARY_CLASS);
    }
  }
}
