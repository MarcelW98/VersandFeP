import * as React from 'react';
import { Link } from '../link';

const LinkWithLineBreaksDemonstrator: React.FunctionComponent = () => (
  <>
    <div style={{ width: '400px', display: 'flex', flexWrap: 'wrap' }}>
      <p style={{ flex: '0 0 100%' }}>Inside fixed-width containers</p>
      <div style={{ paddingRight: '1rem', flex: '1 0 50%' }}>
        {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
        <Link
          label="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy"
          href="#"
          icon="emoji-happy"
          iconPosition="left"
        />
      </div>
      <div style={{ paddingLeft: '1rem', flex: '1 0 50%' }}>
        {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
        <Link
          label="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy"
          href="#"
          icon="emoji-happy"
          iconPosition="right"
        />
      </div>
    </div>
    <br />
    <p>Auto width</p>
    <br />
    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
    <Link
      label="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy"
      href="#"
      icon="emoji-happy"
      iconPosition="left"
    />
    <br />
    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
    <Link
      label="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy"
      href="#"
      icon="emoji-happy"
      iconPosition="right"
    />
  </>
);

export default LinkWithLineBreaksDemonstrator;
