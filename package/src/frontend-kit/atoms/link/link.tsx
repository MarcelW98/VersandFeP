import classNames from 'classnames';
import * as React from 'react';
import { Icon } from '../icon/icon';

interface ATagProps {
  name?: string;
  label: string;
  href: string;
  target?: '_blank' | '_self';
  role?: React.AriaAttributes['aria-roledescription'];
  tabIndex?: number | null;
  icon?: string;
  iconPosition?: 'left' | 'right';
}
interface LinkProps extends ATagProps {
  level?: 'simple' | 'primary' | 'inline';
  disabled?: boolean;
  additionalClasses?: string[];
}

const ATag: React.FunctionComponent<ATagProps> = ({
  name,
  href,
  target = null,
  role = null,
  tabIndex = null,
  label,
  icon = null,
  iconPosition = 'left',
}) => {
  return (
    <a
      aria-label={`Open ${name} ${label}`}
      href={href}
      target={target}
      role={role}
      tabIndex={typeof tabIndex === 'number' ? tabIndex : null}
    >
      {icon && iconPosition === 'left' && <Icon iconName={icon} />}
      {label}
      {icon && iconPosition === 'right' && <Icon iconName={icon} />}
    </a>
  );
};

/**
 * @name    a-link
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {string} level        Type of Link (simple, inline or primary), defaults to 'simple'
 * @param   {string} name         Variant's name to display. Optional.
 * @param   {string} href         HREF-Attribute
 * @param   {string} label        Label to Display
 * @param   {string} role         optional WAI-ARIA role identifier
 * @param   {number} tabIndex     tabIndex attribute for the link element, defaults to null (no tabIndex override)
 * @param   {boolean} disabled    Whether or not the Link is disabled, defaults to false
 * @param   {string} target       Open Links in same or new window (_self or _blank), optional
 * @param   {string} icon         an icon name of an icon to add, optional; note that only non-UI-icons are supported here,
 *                                ignored for links that are not of level 'simple'
 * @param   {string} iconPosition 'left' or 'right', controls position, defaults to 'left'
 * @description
 * representation of links
 */
const Link: React.FunctionComponent<LinkProps> = ({
  name,
  level = 'simple',
  href,
  label,
  disabled = false,
  target = '_self',
  additionalClasses = [],
  role = null,
  tabIndex = null,
  icon = null,
  iconPosition = 'left',
}: LinkProps) => {
  const isInlineLink = level === 'inline';

  if (isInlineLink) {
    return (
      <ATag
        href={href}
        target={target}
        role={role}
        tabIndex={tabIndex}
        label={label}
        name={name}
      />
    );
  }

  const linkClass = classNames(
    'a-link',
    {
      'a-link--primary': level === 'primary',
      'a-link--simple': level === 'simple',
      '-disabled': disabled,
      '-icon-left': level === 'simple' && icon && iconPosition === 'left',
      '-icon-right': level === 'simple' && icon && iconPosition === 'right',
    },
    ...additionalClasses,
  );

  return (
    <div className={linkClass}>
      <ATag
        name={name}
        href={href}
        target={target}
        role={role}
        tabIndex={tabIndex}
        label={label}
        icon={level === 'simple' ? icon : null}
        iconPosition={iconPosition}
      />
    </div>
  );
};

export { Link };
export type { LinkProps };
