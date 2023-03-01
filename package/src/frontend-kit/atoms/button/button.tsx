import classNames from 'classnames';
import * as React from 'react';
import { Icon } from '../icon/icon';


interface BasicButton {
  type?: 'button' | 'submit' | 'reset';
  mode?: 'primary' | 'secondary' | 'tertiary' | 'integrated';
  isDisabled?: boolean;
  icon?: string;
  isUiIcon?: boolean;
  fixedWidth?: boolean;
  action?: string;
  additionalClasses?: string[];
  'aria-haspopup'?: React.AriaAttributes['aria-haspopup'];
  'aria-expanded'?: React.AriaAttributes['aria-expanded'];
  'aria-labelledby'?: React.AriaAttributes['aria-labelledby'];
  tabIndex?: number | null;
  children?: React.ReactNode;
}

interface ButtonWithLabel extends BasicButton {
  'aria-label'?: never;
  label: string;
}

interface ButtonWithAriaLabel extends BasicButton {
  label?: never;
  'aria-label': React.AriaAttributes['aria-label'];
}

type ButtonProps = ButtonWithLabel | ButtonWithAriaLabel;

/**
 * @name    a-button
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {string} type                 Type of Attribute (button, submit, reset)
 * @param   {string} mode                 Type of Button Definition (Primary, Secondary, Tertiary, Integrated or Inverted)
 * @param   {string} label                Label to Display
 * @param   {boolean} isDisabled          Disable or not the Button
 * @param   {string} icon                 Icon to Display
 * @param   {isUiIcon}  boolean           whether or not it's an icon from the UI font or not
 * @param   {boolean} fixedWidth          Fixed or not fixed width
 * @param   {string} action               Name of the action this button should be used for
 * @param   {string[]} additionalClasses  Additional css classes
 * @param   {string} ariaHaspopup         Accessibility role. Used for popup context menu or sub-level menu.
 * @param   {string} ariaExpanded         Accessibility expanded. Used for toggle button.
 * @param   {string} ariaLabel            Accessibility label. Used if label doesn't exist
 * @param   {string} ariaLabelledBy       Accessibility label. Used if label does exist.
 * @param   {number} tabIndex             Index of sequential keyboard navigation
 *
 * @description
 * representation of buttons
 */

const Button: React.FunctionComponent<ButtonProps> = ({
  type = 'button',
  mode = 'primary',
  isDisabled,
  label,
  icon,
  isUiIcon,
  fixedWidth,
  action = null,
  additionalClasses = [],
  'aria-haspopup': ariaHaspopup = null,
  'aria-label': ariaLabel = null,
  'aria-labelledby': ariaLabelledBy = null,
  'aria-expanded': ariaExpanded = null,
  tabIndex = null,
  children = null,
}) => {
  const buttonClass = classNames(
    'a-button',
    {
      [`a-button--${mode}`]: mode,
      '-fixed': fixedWidth,
      '-without-icon': label && !icon,
      '-without-label': icon && !label,
    },
    ...additionalClasses,
  );

  return (
    <button
      // eslint-disable-next-line react/button-has-type
      type={type}
      className={buttonClass}
      disabled={isDisabled}
      data-frok-action={action}
      aria-haspopup={ariaHaspopup}
      aria-expanded={ariaExpanded}
      aria-label={ariaLabel}
      aria-labelledby={ariaLabelledBy}
      tabIndex={typeof tabIndex === 'number' ? tabIndex : null}
    >
      {icon && !children && (
        <Icon
          iconName={icon}
          className="a-button__icon"
          titleText="Lorem Ipsum"
          isUiIcon={isUiIcon}
        />
      )}
      {label && !children && <div className="a-button__label">{label}</div>}
      {/* if child nodes a provided the inner markup rendering of the button will not run */}
      {children && children}
    </button>
  );
};

export { Button };
export type { ButtonProps };
