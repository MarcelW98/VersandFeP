import * as React from 'react';
import { Icon } from '../../atoms/icon/icon';


interface TableProps {
  // boolean to decide if static highlighted row is needed
  highlightedRow?: boolean;
}

/**
 * @name    m-table
 * @type    molecule
 *
 * @description
 * This is the whole table molecule
 */

/**
 * @name renderHeader
 * @returns header row in bold
 */
function renderHeader(): any {
  return (
    <tr>
      <th>Header</th>
      <th>Header</th>
      <th>Header</th>
      <th>Header</th>
      <th>Header</th>
    </tr>
  );
}

function renderRow(): any {
  return (
    <>
      <td>Neutral</td>
      <td>Neutral</td>
      <td>
        <Icon iconName="emoji-happy" titleText="happy emoji" />
      </td>
      <td>Neutral</td>
      <td>Neutral</td>
    </>
  );
}

const Table: React.FunctionComponent<TableProps> = ({
  highlightedRow = false,
}: TableProps) => {
  return (
    <table className="m-table" aria-label="Highlights">
      <thead>{renderHeader()}</thead>
      <tbody>
        <tr>{renderRow()}</tr>
        <tr>{renderRow()}</tr>
        <tr className={highlightedRow ? '-secondary' : ''}>{renderRow()}</tr>
        <tr>{renderRow()}</tr>
      </tbody>
    </table>
  );
};

export { Table };
export type { TableProps };
