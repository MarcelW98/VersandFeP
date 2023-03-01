import * as React from 'react';
import { TabNavigation } from '../tabNavigation';

const SimpleTabbedContentDemonstrator: React.FunctionComponent<{}> = () => (
  <div className="frontend-kit-example_tabbed-content">
    <TabNavigation
      tabs={[
        {
          type: 'button',
          label: 'Content 1',
          identifier: 'content-1',
          isSelected: true,
        },
        {
          type: 'button',
          label: 'Content 2',
          identifier: 'content-2',
        },
      ]}
    />
    <div
      className="frontend-kit-example_content"
      style={{ textAlign: 'center' }}
      data-frok-content-identifier="content-1"
    >
      <p>Content 1</p>
    </div>
    <div
      className="frontend-kit-example_content"
      style={{ textAlign: 'center', display: 'none' }}
      data-frok-content-identifier="content-2"
    >
      <p>Content 2</p>
    </div>
  </div>
);

export default SimpleTabbedContentDemonstrator;
