/* eslint-disable max-classes-per-file */
import * as React from 'react';
import { Icon } from '../icon/icon';

interface Option {
  identifier: string;
  label?: string;
  icon?: string;
  isDisabled?: boolean;
  isSelected?: boolean;
}

interface OptionBarProps {
  options: Option[];
}

/**
 * @name    a-option-bar
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {string}        type        Type of options Definition (Labels, Icons, or Labels&Icons)
 * @param   {OptionProps}   options     The options the OptionBar consists of
 *
 * @description
 * representation of Option Bar components
 */

const OptionBar: React.FunctionComponent<OptionBarProps> = ({
  options = [],
}: OptionBarProps) => {
  return (
    <ul className="a-option-bar">
      {options.map(option => {
        return (
          <li key={option.identifier} className="a-option-bar__item">
            <input
              type="radio"
              id={option.identifier}
              name="demo"
              checked={option.isSelected}
              disabled={option.isDisabled}
            />
            <label className="a-option-bar__option" htmlFor={option.identifier}>
              {option.icon && (
                <Icon
                  iconName={option.icon}
                  className="a-option-bar__icon"
                  titleText="Lorem Ipsum"
                />
              )}
              {option.label && (
                <div className="a-option-bar__label">{option.label}</div>
              )}
            </label>
          </li>
        );
      })}
    </ul>
  );
};

export { OptionBar };
export type { OptionBarProps };
