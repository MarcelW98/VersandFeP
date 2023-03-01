import BaseComponent from '../../baseComponent';

const UNSELECTED_STAR_CLASS = 'ui-ic-nosave-star';
const SELECTED_STAR_CLASS = 'ui-ic-nosave-star-fill';
const SELECTED_HALF_STAR_CLASS = 'ui-ic-nosave-star-half';
let OLD_VALUE = 0;

class Rating extends BaseComponent {
  private stars: NodeList;
  private starLabels: NodeList;
  private isLink: boolean;
  constructor(container: HTMLElement) {
    super(container);

    /**
     * Define DOM Elements and Variables
     */
    this.stars = container.querySelectorAll(
      'input[type="radio"]',
    ) as NodeListOf<HTMLInputElement>;

    this.starLabels = container.querySelectorAll(
      'label',
    ) as NodeListOf<HTMLLabelElement>;

    // if container is link, return
    this.isLink = container.classList.contains('a-rating--link');
    if (this.isLink) return;

    Array.from(this.starLabels).forEach((starLabel) => {
      if (starLabel instanceof HTMLLabelElement) {
        const starInput = starLabel.querySelector(
          'input[type="radio"]',
        ) as HTMLInputElement;
        const starValue = parseInt(starInput.value, 10);

        starLabel.addEventListener('click', () => {
          this.setRatingStars(starValue, true);
          this.setRatingLabel(starValue);
        });

        // hover
        starLabel.addEventListener('mouseover', () => {
          this.setRatingStars(starValue, false);
        });
      }
    });

    container.addEventListener('mouseout', () => {
      this.setRatingStars(OLD_VALUE, false);
    });
  }

  public setRatingStars = (rating: number, override: boolean): void => {
    if (rating > this.stars.length) {
      rating = this.stars.length;
    }

    if (override) {
      OLD_VALUE = rating;
    }

    Array.from(this.stars).forEach((star, index) => {
      const icon = star.nextElementSibling;
      const starIndex = index + 1;
      const isHalfStar = rating % 1 !== 0 && starIndex === Math.ceil(rating);
      const isSelected = starIndex <= rating;
      const isEmpty = starIndex > rating && !isHalfStar;

      // check if full star
      if (isSelected) {
        if (icon instanceof HTMLElement) {
          icon.classList.remove(UNSELECTED_STAR_CLASS);
          icon.classList.remove(SELECTED_HALF_STAR_CLASS);
          icon.classList.add(SELECTED_STAR_CLASS);
        }
      }
      // check if half star
      if (isHalfStar) {
        if (icon instanceof HTMLElement) {
          icon.classList.remove(UNSELECTED_STAR_CLASS);
          icon.classList.remove(SELECTED_STAR_CLASS);
          icon.classList.add(SELECTED_HALF_STAR_CLASS);
        }
      }
      // unselect all stars
      if (isEmpty) {
        if (icon instanceof HTMLElement) {
          icon.classList.remove(SELECTED_STAR_CLASS);
          icon.classList.remove(SELECTED_HALF_STAR_CLASS);
          icon.classList.add(UNSELECTED_STAR_CLASS);
        }
      }
    });
  };

  // set rating Label
  private setRatingLabel = (rating: number): void => {
    const ratingLabel = this.container.querySelector('.a-rating__label');
    const ratingText = this.isLink
      ? `${rating}`
      : `(${rating}/${this.stars.length})`;

    if (ratingLabel instanceof HTMLElement) {
      ratingLabel.innerText = ratingText;
    }
  };

  // return rating
  public getRating = (): number => {
    const rating = this.container.querySelector('.a-rating__label');
    if (rating instanceof HTMLElement) {
      return parseFloat(rating.innerText);
    }
    return 0;
  };
}

export default Rating;
