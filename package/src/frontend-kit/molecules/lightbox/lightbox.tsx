import classNames from 'classnames';
import * as React from 'react';
import { Button } from '../../atoms/button/button';
import { Image } from '../../atoms/image/image';
import LightboxComponent from './index';




interface LightboxProps {
  // a page-unique identifier
  lightboxId?: string;
  // if true, show a modal
  modal?: boolean;
  // variant identifier
  sequence?: boolean;
  // modifier identifier
  extended?: boolean;
  // Array of images
  images?: [
    {
      srcSet: {
        source: string;
        width: number;
      }[];
      defaultSrc: string;
      altText: string;
      caption: string;
    },
  ];
}

const Lightbox: React.FunctionComponent<LightboxProps> = ({
  sequence,
  extended,
  lightboxId,
  modal = false,
  images,
}) => {
  const prefixedLightboxId = LightboxComponent.lightboxId(lightboxId);
  const lightboxTitleId = `${prefixedLightboxId}-title`;

  const lightboxClasses = classNames('m-lightbox', {
    '-extended': extended,
    'm-lightbox--sequence': sequence,
  });

  return (
    <div
      className={lightboxClasses}
      id={prefixedLightboxId}
      role="figure"
      aria-label={lightboxTitleId}
    >
      <div className="a-box--modal">
        <div className="m-lightbox__wrapper">
          <div className="m-lightbox__aspect-wrapper">
            <div className="m-lightbox__background -floating" />
            <div className="m-lightbox__header -primary">
              <Button
                action="close"
                mode="integrated"
                icon="close"
                aria-label="close lightbox"
                isUiIcon
              />
            </div>
            <div className="m-lightbox__content">
              <div className="m-lightbox__image-wrapper">
                {images.map((image, index) => {
                  const { srcSet, altText, defaultSrc } = image;
                  const key = `image-${index}`;
                  const { caption } = image;

                  // The caption below will show only when '-extended' class is true.
                  return (
                    <Image
                      srcSet={srcSet}
                      defaultSrc={defaultSrc}
                      altText={altText}
                      caption={extended && caption}
                      key={key}
                    />
                  );
                })}
              </div>
            </div>
            {(sequence || extended) && (
              <div className="m-lightbox__footer">
                {images.length > 1 && (
                  <div className="m-lightbox__counter -primary">
                    1 / {images.length}
                  </div>
                )}
                <Button
                  action="expand"
                  mode="integrated"
                  icon="up"
                  aria-label="expand additional content lightbox"
                  isUiIcon
                  additionalClasses={['m-lightbox__expand']}
                />
                {images.length > 1 && (
                  <div className="m-lightbox__sequence-buttons -primary">
                    <Button
                      action="left"
                      mode="integrated"
                      icon="left"
                      aria-label="previous image lightbox"
                      isUiIcon
                    />
                    <Button
                      action="right"
                      mode="integrated"
                      icon="right"
                      aria-label="next image lightbox"
                      isUiIcon
                    />
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export { Lightbox };
export type { LightboxProps };
