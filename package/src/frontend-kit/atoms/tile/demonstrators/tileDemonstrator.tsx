// eslint-disable-next-line no-use-before-define
import * as React from 'react';

import { Tile } from '../tile';
import { Image, ImageProps } from '../../image/image';
import { Icon } from '../../icon/icon';

interface TileDemonstratorProps {
  name: string;
  background: 'primary' | 'secondary' | 'contrast';
  fill?: 'purple' | 'blue' | 'turquoise' | 'green';
  category: string;
  headline: string;
  subheadline: string;
  image: ImageProps;
  isSmall: boolean;
}

const TileDemonstrator: React.FunctionComponent<TileDemonstratorProps> = ({
  name,
  background,
  fill,
  category,
  headline,
  subheadline,
  image,
  isSmall,
}) => {
  return (
    <Tile name={name} background={background} fill={fill}>
      {image && (
        <Image
          srcSet={image.srcSet}
          altText={image.altText}
          caption={image.caption}
          defaultSrc={image.defaultSrc}
        />
      )}
      <div
        className="a-text"
        style={isSmall ? { padding: '1rem' } : { padding: '2rem' }}
      >
        <span className="-size-s" style={{ marginBottom: '0.5rem' }}>
          {category}
        </span>
        <h3
          className={isSmall ? '-size-l' : '-size-xl'}
          style={{ marginBottom: '0.75rem', marginTop: '0rem' }}
        >
          {headline}
          <Icon
            isUiIcon
            iconName="inline-right"
            style={{ marginLeft: '0.5rem' }}
          />
        </h3>
        <p className="-size-m" style={{ margin: '0rem' }}>
          {subheadline}
        </p>
      </div>
    </Tile>
  );
};

export default TileDemonstrator;
