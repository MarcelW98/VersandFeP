// eslint-disable-next-line no-use-before-define
import * as React from 'react';
import { Image, ImageProps } from '../image/image';

interface SelectableTileProps {
  name: string;
  id: string;
  type?: 'checkbox' | 'radio';
  size?: 'small' | 'large';
  image: ImageProps;
  headline: string;
  subheadline: string;
}

/**
 * @name        a-tile
 * @type        atom
 *
 * @param       {string}  name            Tile's name.
 * @param       {string}  id              Tile's id.
 * @param       {string}  type            Tile's type.
 * @param       {string}  size            Tile's size.
 * @param       {ImageProps}  image          Tile's image.
 * @param       {string}  headline        Tile's headline.
 * @param       {string}  subheadline      Tile's subheadline.

 * @description
 * representation of tile
 */

const SelectableTile: React.FunctionComponent<SelectableTileProps> = ({
  name,
  id,
  type = 'radio',
  size = 'large',
  image,
  headline,
  subheadline,
}) => {
  const tileClass = `a-selectable-tile a-selectable-tile--${type} -${size}`;

  return (
    <div className={tileClass}>
      <input type={type} name={name} id={`unique_${id}`} />
      <label htmlFor={`unique_${id}`} aria-label={name}>
        {type === 'checkbox' && <div className="checkbox-container" />}
        {image && size === 'large' && (
          <Image
            srcSet={image.srcSet}
            altText={image.altText}
            caption={image.caption}
            defaultSrc={image.defaultSrc}
          />
        )}
        <div className="a-text">
          <p className="-size-m highlight a-text__headline">{headline}</p>
          {size === 'large' && (
            <p className="-size-s a-text__subheadline">{subheadline}</p>
          )}
        </div>
      </label>
    </div>
  );
};

export { SelectableTile, SelectableTileProps };
