import * as React from 'react';

import { Button } from '../../../atoms/button/button';

const MenuTrigger: React.FunctionComponent = () => (
  <Button
    type="button"
    mode="integrated"
    additionalClasses={['o-header__menu-trigger']}
    aria-label="Toggle Main Navigation"
    aria-haspopup="true"
  >
    <i className="o-header__menu-trigger-icon a-icon a-button__icon">
      <span className="o-header__menu-trigger-icon-bar" />
      <span className="o-header__menu-trigger-icon-bar" />
      <span className="o-header__menu-trigger-icon-bar" />
      <span className="o-header__menu-trigger-icon-bar" />
    </i>
    <span className="o-header__menu-trigger-label a-button__label">Menu</span>
  </Button>
);

export default MenuTrigger;
