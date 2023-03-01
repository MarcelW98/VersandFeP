import * as React from 'react';
import classNames from 'classnames';

import { Icon } from '../icon/icon';

class TableCellProps {
  label: string;
  highlighted: boolean;
  bold: boolean;
  iconName: string;
}

/**
 * @name    m-table-cell
 * @type    atom
 *
 * @param   label           The content of the cell
 * @param   highlighted     Modifier to set the cell as highlighted
 * @param   iconName        The name of the icon to display
 *
 * @description
 * This is a single cell of a table
 */

const TableCell: React.FunctionComponent<TableCellProps> = ({
  label,
  highlighted,
  iconName,
}: TableCellProps) => {
  const tableCellClass: string = classNames({
    '-secondary': highlighted,
  });
  return (
    <table className="m-table">
      <tr>
        <td className={tableCellClass}>
          {iconName !== undefined && (
            <Icon iconName={iconName} titleText="icon tooltip" />
          )}
          {label !== undefined && <>{label}</>}
        </td>
      </tr>
    </table>
  );
};

export { TableCell, TableCellProps };
