import classNames from 'classnames';
import * as React from 'react';

interface BadgeProps {
  label: string;
  type?: 'warning' | 'error';
}

/**
 * @name    a-badge
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {string} type                 Type of badge (neutral, warning, error)
 * @param   {string} label                Label to Display
 *
 * @description
 * representation of badges
 */

const Badge: React.FunctionComponent<BadgeProps> = ({ label, type }) => {
  const badgeClass = classNames('a-badge', {
    [`-${type}`]: type,
  });

  return <div className={badgeClass}>{label}</div>;
};

export { Badge };
export type { BadgeProps };
