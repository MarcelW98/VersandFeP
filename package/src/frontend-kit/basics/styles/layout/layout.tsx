import classNames from 'classnames';
import * as React from 'react';

interface LayoutProps {
  isFullWidth?: boolean;
  backgroundType?: 'primary' | 'secondary' | 'floating' | 'contrast';
  children: React.ReactElement[] | React.ReactElement;
}
/**
 * @name    Layout
 * @type    basic
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @description
 * example page to show of basic typo usage
 */
const Layout: React.FunctionComponent<LayoutProps> = ({
  isFullWidth,
  backgroundType,
  children,
}: LayoutProps) => {
  const layoutClasses = classNames('e-container', {
    '-full-width': isFullWidth,
    [`-${backgroundType}`]: backgroundType,
  });

  return <div className={layoutClasses}>{children}</div>;
};

export { Layout };
export type { LayoutProps };
