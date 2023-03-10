import * as React from 'react';

interface SrcSet {
  source: string;
  width: number;
}

interface ImageProps {
  srcSet: SrcSet[];
  altText: string;
  caption: string;
  defaultSrc: string;
}

/**
 * @name    a-image
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {array}   srcSet      array of objects with given srcSet key-value pairs
 * @param   {string}  altText     alternative Text of the Image
 * @param   {string}  caption     caption text of the image
 * @description
 * simple image component
 */
const Image: React.FunctionComponent<ImageProps> = ({
  srcSet,
  altText,
  caption,
  defaultSrc,
}) => {
  const srcString: string = srcSet.reduce(
    (previousValue, currentValue): string => {
      const { source, width } = currentValue;
      if (previousValue === '') {
        return `${source} ${width}w`;
      }
      return `${previousValue}, ${source} ${width}w`;
    },
    '',
  );

  return (
    <figure className="a-image">
      <div className="a-image__ratioWrapper">
        <img src={defaultSrc} srcSet={srcString} alt={altText} />
      </div>
      {caption && <figcaption>{caption}</figcaption>}
    </figure>
  );
};

export { Image };
export type { ImageProps };
