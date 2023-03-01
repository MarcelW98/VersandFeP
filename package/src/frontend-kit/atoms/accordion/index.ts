import BaseComponent from '../../baseComponent';

export default class Accordion extends BaseComponent {
  protected static events = ['onClick'];
  private readonly accordion: HTMLElement;
  private readonly accordionHead: HTMLElement;
  private readonly accordionContent: HTMLElement;
  private accordionIcon: HTMLElement;

  constructor(container: HTMLElement) {
    super(container);

    /**
     * Define DOM Elements and Variables
     */
    this.accordion = container;
    this.accordionHead = this.accordion.querySelector('.a-accordion__headline');
    this.accordionIcon = this.accordionHead.querySelector(
      '.a-accordion__headline-icon',
    );
    this.accordionContent = container.querySelector('.a-accordion__content');

    this.accordionHead.addEventListener('click', () => {
      this.toggleClass();
    });
  }

  private toggleClass = function () {
    this.accordion.classList.toggle('a-accordion--open');
    if (this.accordion.classList.contains('a-accordion--open')) {
      this.accordionIcon.classList.remove('boschicon-bosch-ic-down');
      this.accordionIcon.classList.add('boschicon-bosch-ic-up');
    } else {
      this.accordionIcon.classList.remove('boschicon-bosch-ic-up');
      this.accordionIcon.classList.add('boschicon-bosch-ic-down');
    }
  };
}
