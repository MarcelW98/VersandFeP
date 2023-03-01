import classNames from 'classnames';
import * as React from 'react';

class ChipProps {
  name: string;
  label: string;
  disabled?: boolean;
  buttonClose?: boolean;
  image?: string;
  fixedWidth?: boolean;
  selected?: boolean;
  dragged?: boolean;
  buttonPair?: boolean;
}

/**
 * @name    a-chip
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 * @param   {string} name           Name of Chip
 * @param   {string} label          Label of Chip
 * @param   {boolean} disabled      Disable Chip
 * @param   {boolean} buttonClose   Show Close Button
 * @param   {string} image          URL of Image to show
 * @param   {boolean} fixedWidth    Set Chip to have a fixed Width
 * @param   {boolean} selected      Set Chip to selected State
 * @param   {boolean} dragged       Set Chip to dragged State
 * @param   {boolean} buttonPair    Render two Chips (for Preview-Purposes only)
 * @description
 * representation of chip elements
 */
const Chip: React.FunctionComponent<ChipProps> = ({
  name,
  label,
  disabled,
  buttonClose,
  image,
  fixedWidth,
  selected,
  dragged,
  buttonPair,
}: ChipProps) => {
  const elementClass = classNames('a-chip', {
    'a-chip--fixed': fixedWidth,
    '-disabled': disabled,
    '-btnClose': buttonClose,
    '-image': image,
    '-selected': selected,
    '-dragged': dragged,
  });

  const style = {
    backgroundImage: `url('${image}')`,
  };

  const imageMarkup = (
    <div className="a-chip__image" style={image ? style : null} />
  );
  const chipLabelId = `chip-label-id-${name.replace(' ', '-')}`;
  const labelMarkup = (
    <span id={chipLabelId} className="a-chip__label">
      {label}
    </span>
  );

  let imageLabelMarkup;
  if (image && fixedWidth) {
    imageLabelMarkup = (
      <div className="fixed-width-image-label-group">
        {imageMarkup}
        {labelMarkup}
      </div>
    );
  } else {
    imageLabelMarkup = (
      <>
        {image && imageMarkup}
        {labelMarkup}
      </>
    );
  }
  const closeButtonMarkup = <div className="a-chip__close" />;

  const chipMarkup = (
    <div className={elementClass} role="button" aria-labelledby={chipLabelId}>
      {imageLabelMarkup}
      {buttonClose && closeButtonMarkup}
    </div>
  );

  const buttonPairMarkup = (
    <>
      <div className={elementClass} role="button" aria-labelledby={chipLabelId}>
        <span id={chipLabelId} className="a-chip__label">
          {label}
        </span>
      </div>
      <div
        className={elementClass}
        role="button"
        aria-labelledby="chip-label-id-two-chips-02"
      >
        <span id="chip-label-id-two-chips-02" className="a-chip__label">
          {label}
        </span>
      </div>
    </>
  );

  return <>{!buttonPair ? chipMarkup : buttonPairMarkup}</>;
};

export { Chip, ChipProps };
