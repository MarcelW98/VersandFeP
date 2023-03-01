import * as React from 'react';
import { Button } from '../../../atoms/button/button';
import { Lightbox, LightboxProps } from '../lightbox';

const ModalLightbox: React.FunctionComponent<LightboxProps> = ({
  lightboxId,
  images,
  sequence = false,
  extended = false,
}) => (
  <div
    className="frontend-kit-example_modal-lightbox"
    data-frok-show-lightbox={lightboxId}
  >
    <Button label="click here" action="show" />
    <Lightbox
      modal
      lightboxId={lightboxId}
      images={images}
      sequence={sequence}
      extended={extended}
    />
  </div>
);

export default ModalLightbox;
