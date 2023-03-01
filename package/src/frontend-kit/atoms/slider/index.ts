import BaseComponent from '../../baseComponent';

export default class TextField extends BaseComponent {
  protected static events = ['onClick'];

  private readonly slider: HTMLInputElement;

  private readonly tooltip: HTMLElement;

  constructor(container: HTMLElement) {
    super(container);

    /**
     * Define DOM Elements and Variables
     */
    this.slider = container.querySelector('.a-slider input[type=range]');
    this.tooltip = container.querySelector('.a-tooltip');

    // init tooltip
    this.setTooltip();

    if (this.slider instanceof HTMLElement) {
      this.slider.addEventListener('input', () => {
        this.setTooltip();
      });
      this.slider.addEventListener('mouseenter', () => {
        this.toggleTooltipVisibility(false);
      });
      this.slider.addEventListener('mouseleave', () => {
        this.toggleTooltipVisibility(true);
      });
    }
  }

  private setTooltip(): void {
    if (!this.tooltip) {
      return;
    }

    const min: number = this.slider.min ? Number(this.slider.min) : 0;

    const max: number = this.slider.max ? Number(this.slider.max) : 100;
    const percentage = Number(
      ((this.slider.valueAsNumber - min) * 100) / (max - min),
    );

    // fill tooltip with data
    if (this.tooltip.getAttribute('tooltip-type') === 'relative') {
      this.tooltip.innerHTML = `${percentage} %`;
    } else if (this.tooltip.getAttribute('tooltip-unit')) {
      this.tooltip.innerHTML = `${this.slider.value}${this.tooltip.getAttribute(
        'tooltip-unit',
      )}`;
    } else {
      this.tooltip.innerHTML = this.slider.value;
    }

    this.calculateAndSetTooltipPosition(percentage);
  }

  /**
   * The tooltip needs to be placed directly over the center of the thumb element.
   * To calculate where the tooltip is placed, we use the percentage of the slider as a base.
   * Then half the tooltip width is subtracted.
   * When the thumb element is placed at the ends of the spectrum, its center is not placed directly over the percentage value.
   * The offset caused by the thumb position follows a linear function based on the percentage.
   * The position of the tooltip needs to be corrected for that.
   *
   * @param percentage  The percentage value of the slider
   */
  private calculateAndSetTooltipPosition(percentage: number): void {
    const tooltipOffsetRem = this.tooltip.offsetWidth / 2 / 16;
    const thumbOffsetFactor = percentage / 100 - 0.5;

    // thumb has 1.5rem
    const offsetRem = tooltipOffsetRem + thumbOffsetFactor * 1.5;

    this.tooltip.style.left = `calc(${percentage}% - (${offsetRem}rem))`;
  }

  private toggleTooltipVisibility(isHidden: boolean): void {
    if (!this.tooltip) {
      return;
    }
    this.tooltip.style.visibility = isHidden ? 'hidden' : 'visible';
  }
}
