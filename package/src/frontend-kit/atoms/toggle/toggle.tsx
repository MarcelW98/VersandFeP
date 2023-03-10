import * as React from 'react';
import classNames from 'classnames';

class ToggleProps {
  id: string;
  disabled?: boolean;
  checked?: boolean;
  leftLabel?: string;
  rightLabel?: string;
}

/**
 * @name    a-toggle
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 * @param {number}  id          ID of Toggle-Component
 * @param {boolean} disabled    Disable Toggle-Component
 * @param {boolean} checked     Set Checked State
 * @param {string}  leftLabel   Text shown on Left Label
 * @param {string}  rightLabel  Text shown on Right Label
 * @description
 * representation of toggle elements
 */
const Toggle: React.FunctionComponent<ToggleProps> = ({
  id,
  disabled,
  checked,
  leftLabel,
  rightLabel,
}: ToggleProps) => {
  const elementClass = classNames('a-toggle', {
    '-disabled': disabled,
  });

  return (
    <div className={elementClass}>
      {leftLabel && (
        <label className="a-toggle__label -left" htmlFor={id}>
          {leftLabel}
        </label>
      )}
      <input
        type="checkbox"
        id={id}
        name={id}
        disabled={disabled}
        checked={checked}
      />
      {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
      <label className="a-toggle__box" htmlFor={id} />
      {rightLabel && (
        <label className="a-toggle__label -right" htmlFor={id}>
          {rightLabel}
        </label>
      )}
    </div>
  );
};

export { Toggle, ToggleProps };
