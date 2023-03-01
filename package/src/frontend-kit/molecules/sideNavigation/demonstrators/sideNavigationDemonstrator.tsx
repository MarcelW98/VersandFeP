import * as React from 'react';
import { SideNavigation, SideNavigationProps } from '../sideNavigation';
import { Button } from '../../../atoms/button/button';

const divStyle = {
  alignItems: 'center',
  display: 'flex',
  height: '100vh',
  justifyContent: 'center',
  width: '100vw',
};

const SideNavigationDemonstrator: React.FunctionComponent<SideNavigationProps> = ({
  appName,
  menuItems,
}) => {
  return (
    <>
      <style
        /* eslint-disable-next-line react/no-danger */
        dangerouslySetInnerHTML={{
          __html: `
            @media (min-width: 1194px) {
              .a-button[data-frok-action="show"] {
                display: none;
              }
            }
          `,
        }}
      />
      <div className="frontend-kit-example_side-navigation">
        <SideNavigation menuItems={menuItems} appName={appName} />
        <div style={divStyle}>
          <Button type="button" mode="primary" label="click me" action="show" />
        </div>
      </div>
    </>
  );
};

export default SideNavigationDemonstrator;
