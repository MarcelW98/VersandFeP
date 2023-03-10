import classNames from 'classnames';
import * as React from 'react';
import { Image } from '../../atoms/image/image';
import { Text } from '../../atoms/text/text';


interface TextImageProps {
  order: 'default' | 'left-to-right' | 'right-to-left';
  headingText: {
    headline: {
      level: number;
      content: string;
    };
    paragraph?: string[];
  }[];
  image: {
    srcSet: {
      source: string;
      width: number;
    }[];
    defaultSrc: string;
    altText: string;
    caption: string;
  };
  paragraph: {
    paragraph: string[];
  }[];
}

/**
 * @name    m-textImage
 * @type    molecule
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @description
 * representation of text alongside images
 */
const TextImage: React.FunctionComponent<TextImageProps> = ({
  order,
  headingText,
  image,
  paragraph,
}) => {
  // construction of class names with baseClass for repetitive string
  const baseClass = 'm-text-image__order-wrapper';
  const textImageClass: string = classNames(baseClass, {
    [`${baseClass}--${order}`]: order !== 'default',
  });

  const { srcSet, altText, caption, defaultSrc } = image;
  return (
    <div className="m-text-image">
      <Text content={headingText} />
      <div className={textImageClass}>
        <Image
          srcSet={srcSet}
          defaultSrc={defaultSrc}
          altText={altText}
          caption={caption}
        />
        <Text content={paragraph} />
      </div>
    </div>
  );
};

export { TextImage };
export type { TextImageProps };
