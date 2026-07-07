export default function Table({ columns = [], rows = [], emptyMessage = 'No records found.' }) {
    return (
        <div className="overflow-x-auto rounded-lg ring-1 ring-gray-200">
            <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                    <tr>
                        {columns.map((column) => (
                            <th
                                key={column.key}
                                scope="col"
                                className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"
                            >
                                {column.label}
                            </th>
                        ))}
                    </tr>
                </thead>
                <tbody className="divide-y divide-gray-100 bg-white">
                    {rows.length === 0 ? (
                        <tr>
                            <td colSpan={columns.length} className="px-4 py-6 text-center text-sm text-gray-500">
                                {emptyMessage}
                            </td>
                        </tr>
                    ) : (
                        rows.map((row, rowIndex) => (
                            <tr key={row.id ?? rowIndex}>
                                {columns.map((column) => (
                                    <td key={column.key} className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">
                                        {column.render ? column.render(row) : row[column.key]}
                                    </td>
                                ))}
                            </tr>
                        ))
                    )}
                </tbody>
            </table>
        </div>
    );
}
