import classNames from 'classnames';
import * as React from 'react';

class StickerProps {
  name?:
    | 'primary'
    | 'secondary'
    | 'contrast'
    | 'turquoise'
    | 'purple'
    | 'green';
  label: string;
}

/**
 * @name    a-sticker
 * @type    atom
 * @author UDG Rhein-Main GmbH
 * @copyright Robert Bosch GmbH
 * @param   {string} name           Name of Sticker Definition (Primary, Secondary, Tertiary, Integrated or Inverted)
 * @param   {string} label          Label of Sticker
 * @description
 * representation of sticker elements
 */
const Sticker: React.FunctionComponent<StickerProps> = ({
  name = 'primary',
  label,
}: StickerProps) => {
  const elementClass = classNames('a-sticker', {
    [`-${name}`]: name,
  });

  const stickerLabelId = `sticker-label-id-${name.replace(' ', '-')}`;
  const labelMarkup = (
    <span id={stickerLabelId} className="a-sticker__label -size-s">
      {label}
    </span>
  );

  const stickerMarkup = (
    <div className={elementClass} aria-labelledby={stickerLabelId}>
      {labelMarkup}
    </div>
  );

  return <>{stickerMarkup}</>;
};

export { Sticker, StickerProps };
