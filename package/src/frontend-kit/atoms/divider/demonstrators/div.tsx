import * as React from 'react';

const divDemoStyle: React.CSSProperties = {
  alignItems: 'center',
  backgroundColor: 'lightblue',
  display: 'flex',
  justifyContent: 'center',
  padding: '20px',
  textAlign: 'center',
};

const DivDemonstrator: React.FunctionComponent = () => (
  <div className="container -row">
    <div style={divDemoStyle}>
      This is a demo text. Instead of this DIV, you can use any other HTML tag.
    </div>
    <hr className="a-divider a-divider--vertical" />
    <div style={divDemoStyle}>
      This is a demo text. Instead of this DIV, you can use any other HTML tag.
    </div>
  </div>
);

export default DivDemonstrator;
