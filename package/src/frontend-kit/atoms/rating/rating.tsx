import * as React from 'react';
import classNames from 'classnames';
import { Icon } from '../icon/icon';

class RatingProps {
  size?: 'small' | 'large';
  variant?: 'selection' | 'link';
  label: boolean;
  amountOfStars: number;
  rating: number;
  completedAmount: number;
  iconFull?: string;
  iconHalf?: string;
  iconEmpty?: string;
  disabled?: boolean;
}

/**
 * @name    a-rating
 * @type    atom
 * @author UDG Rhein-Main GmbH
 * @copyright Robert Bosch GmbH
 * @param   {string} size		   Size of Rating
 * @param   {string} variant		   Variant of Rating
 * @param   {boolean} label     Label of Rating
 * @param   {number} amountOfStars Amount of Stars
 * @param   {number} selectedAmount Selected Amount
 * @param   {number} completedAmount Amount of completed ratings
 * @param   {number} rating	   Average Rating
 * @param   {string} icon		   Icon to Display
 * @param   {string} iconFull	   Icon to Display
 * @param   {string} iconHalf	   Icon to Display
 * @param   {string} iconEmpty	   Icon to Display
 * @param   {boolean} disabled	   Disabled
 * @description
 * representation of rating elements
 */

const Rating: React.FunctionComponent<RatingProps> = ({
  size = 'small',
  variant = 'selection',
  label = false,
  amountOfStars = 5,
  rating = 0,
  completedAmount = 45,
  iconFull = 'nosave-star-fill',
  iconHalf = 'nosave-star-half',
  iconEmpty = 'nosave-star',
  disabled = false,
}: RatingProps) => {
  const elementClass = classNames('a-rating', {
    [`a-rating--${size}`]: size,
    [`a-rating--${variant}`]: variant,
    'a-rating--disabled': disabled,
  });

  const ratingMarkup = (
    <div className={elementClass}>
      <div className="a-rating__star-container">
        {[...Array(amountOfStars)].map((star, i) => {
          const ratingValue = i + 1;
          return (
            // eslint-disable-next-line jsx-a11y/label-has-associated-control
            <label>
              <input type="radio" name="rating" value={ratingValue} />
              <Icon iconName={iconEmpty} isUiIcon />
            </label>
          );
        })}
      </div>

      <div className="a-rating__label-container">
        <span className="a-rating__label a-rating__label--complete">{`(${rating}/${amountOfStars})`}</span>
      </div>
    </div>
  );

  const linkMarkup = (
    <div className={elementClass}>
      <a href="/#" aria-label="Link for rating" target="_blank">
        <div className="a-rating__star-container">
          {[...Array(amountOfStars)].map((star, i) => {
            const ratingValue = i + 1;
            const isHalfStar =
              rating % 1 !== 0 && ratingValue === Math.ceil(rating);
            const isSelected = ratingValue <= rating;

            let iconName = iconEmpty;
            if (isHalfStar) {
              iconName = iconHalf;
            } else if (isSelected) {
              iconName = iconFull;
            }
            return (
              // eslint-disable-next-line jsx-a11y/label-has-associated-control
              <label>
                <input type="radio" name="rating" value={ratingValue} />
                <Icon iconName={iconName} isUiIcon />
              </label>
            );
          })}
        </div>

        {/* if label add labels */}
        {label && (
          <>
            <div className="a-rating__label-container">
              <span className="a-rating__label">{`${rating}`}</span>
              <span className="a-rating__label a-rating__label--complete">{`(${completedAmount})`}</span>
            </div>
          </>
        )}
      </a>
    </div>
  );

  // if variant === selection return ratingMarkup else return linkMarkup
  return variant === 'selection' ? ratingMarkup : linkMarkup;
};

export { Rating };
export type { RatingProps };
