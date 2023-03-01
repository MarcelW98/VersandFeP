import classNames from 'classnames';
import * as React from 'react';

interface CheckboxProps {
  id: string;
  labelCheckbox: string | React.ReactNode;
  isSelected?: boolean;
  isDisabled?: boolean;
  indeterminate?: boolean;
}

/**
 * @name        a-checkbox
 * @type        atom
 * @author      Experience One AG
 * @copyright   Robert Bosch GmbH
 *
 * @param       {string}                    id                Unique ID for each checkbox
 * @param       {string | React.ReactNode}  labelCheckbox     Label to display
 * @param       {boolean}                   isSelected        Select or unselect the input
 * @param       {boolean}                   isDisabled        Wether or not the checkbox is disabled
 * @param       {boolean}                   indeterminate     Wether or not the checkbox is indeterminate
 * @description
 * representation of checkboxes
 */

const Checkbox: React.FunctionComponent<CheckboxProps> = ({
  id,
  labelCheckbox,
  isSelected,
  isDisabled,
  indeterminate,
}: CheckboxProps) => {
  const idCheckbox = `checkbox-${id}`;

  const checkboxClass = classNames('a-checkbox', {
    'a-checkbox--indeterminate': indeterminate,
  });

  return (
    <div className={checkboxClass}>
      <input
        type="checkbox"
        id={idCheckbox}
        defaultChecked={isSelected}
        disabled={isDisabled}
      />
      <label htmlFor={idCheckbox}>{labelCheckbox}</label>
    </div>
  );
};

export { Checkbox };
export type { CheckboxProps };
