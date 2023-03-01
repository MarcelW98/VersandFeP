// eslint-disable-next-line no-use-before-define
import * as React from 'react';

import { ContextMenu, ContextMenuProps } from '../contextMenu';

const ContextMenuDemonstrator: React.FunctionComponent<ContextMenuProps> = ({
  links,
}) => {
  return (
    <div className="frontend-kit-example_context-menu">
      <div className="example-text-context-menu -size-m">
        Click me to show the context menu
      </div>
      <ContextMenu isPopoverArrowMissing links={links} />
    </div>
  );
};

export default ContextMenuDemonstrator;
