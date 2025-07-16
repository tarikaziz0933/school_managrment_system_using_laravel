 <script>
            function loadFees(class_id, year) {
                if (!class_id || !year) {
                    console.warn('Missing class_id or year to fetch yearly fees');
                    return;
                }

                $.ajax({
                    url: `/api/fees/${class_id}/${year}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const thead = $('#fees_table_head');
                        const tbody = $('#fees_table_body');
                        thead.empty(); // clear old data
                        tbody.empty(); // clear old data


                        if (response.status === 'OK' && response.data.length > 0) {
                            const row = `
                            <tr>

                                <th><input type="checkbox" id="select-all" class="mx-auto block"></th>
                                <th class="px-3 py-2 border">SL No</th>

                                <th class="px-3 py-2 border">Fees Name</th>
                                <th class="px-3 py-2 border">Amount</th>
                                <th class="px-3 py-2 border">Less</th>
                                <th class="px-3 py-2 border">Payable</th>
                            </tr>`;
                            thead.append(row);

                            response.data.forEach((fee, index) => {
                                const row = `
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2 border"><input type="checkbox" name="fee_type_ids[]" class="mx-auto block border" value="${fee.id}"></td>
                                    <td class="px-3 py-2 border">
                                        ${index + 1}
                                        <input type="hidden" name="fees[${index}][serial_no]" value="${index + 1}">
                                    </td>
                                    <td class="px-3 py-2 border">
                                        ${fee.fee_type.name}
                                        <input type="hidden" name="fees[${index}][fee_type_id]" value="${fee.fee_type.id}">
                                    </td>
                                    <td class="px-3 py-2 border">
                                        ${fee.amount}
                                        <input type="hidden" name="fees[${index}][amount]" value="${fee.amount}">
                                    </td>
                                    <td class="px-3 py-2 border">
                                        <input type="text" name="less[${fee.id}]" class="w-20 border-gray-300 rounded shadow-sm">
                                    </td>
                                    <td class="px-3 py-2 border">
                                        <input type="text" name="payable[${fee.id}]" class="w-20 border-gray-300 rounded shadow-sm">
                                    </td>
                                </tr>`;
                                tbody.append(row);
                            });
                            // ✅ Attach the select-all functionality
                            $('#select-all').on('change', function() {
                                const isChecked = $(this).is(':checked');
                                $('.fee-checkbox').prop('checked', isChecked);
                            });
                        } else {
                            tbody.append(
                                '<tr><td colspan="6" class="text-center text-red-500 py-4">No fees found for this class and year.</td></tr>'
                            );
                        }
                    },
                    error: function() {
                        console.error('Failed to fetch yearly fees');
                    }
                });
            }
        </script>
