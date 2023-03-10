import classNames from 'classnames';
import * as React from 'react';

interface OptionProps {
  name: string;
  value: string;
}

interface DropdownProps {
  id: string;
  options: OptionProps[];
  disabled?: boolean;
  label?: string;
  isDynamicWidth?: boolean;
}

/**
 * @name        a-dropdown
 * @type        atom
 *
 * @param       id              Unique ID for the dropdown
 * @param       disabled        Whether or not the dropdown is disabled
 * @param       label           Label of text field
 * @param       isDynamicWidth  Indicates that the width of the dropdown should by dynamic based on the longest option
 * @param       options         Allows the specification of dropdown options in the json file
 *
 * @description
 * representation of a dropdown field
 */

const Dropdown: React.FunctionComponent<DropdownProps> = ({
  id,
  disabled,
  label,
  isDynamicWidth,
  options,
}) => {
  const divClass = classNames('a-dropdown', {
    'a-dropdown--dynamic-width': isDynamicWidth,
    'a-dropdown--disabled': disabled,
  });

  return (
    <div className={divClass}>
      {label && <label htmlFor={id}>{label}</label>}
      <select
        id={id}
        disabled={disabled}
        aria-label="here goes the aria label for the dropwdown"
      >
        {options.map((option) => {
          return (
            <option key={`option-${option.value}`} value={`"${option.value}"`}>
              {option.name}
            </option>
          );
        })}
      </select>
    </div>
  );
};

export { Dropdown };
export type { DropdownProps, OptionProps };
