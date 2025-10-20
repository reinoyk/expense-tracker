import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


function initCategoryDonutChart() {
    const chartEl = document.getElementById('categoryDonutChart');
    // Hanya jalankan jika elemen canvas ada di halaman ini
    if (!chartEl) {
        return;
    }

    // Ambil data dari data-attributes
    const data = JSON.parse(chartEl.dataset.chartData || '[]');
    const labels = JSON.parse(chartEl.dataset.chartLabels || '[]');

    // Definisikan palet warna di sini, karena ini adalah bagian dari logika tampilan
    const colorPalette = [
        '#3B82F6', '#10B981', '#F97316', '#8B5CF6', '#EC4899', '#F59E0B', '#6366F1'
    ];

    // Pastikan Chart.js sudah termuat
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded. Please include it in your page.');
        return;
    }
    
    new Chart(chartEl, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Expenses',
                data: data,
                backgroundColor: colorPalette,
                borderWidth: 0,
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    display: false // Kita pakai legend custom dari Blade
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#1F2937',
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const formattedValue = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                            return `${context.label}: ${formattedValue}`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initCategoryDonutChart();

    const addModal = document.getElementById('expenseModal'); 
    const editModal = document.getElementById('editExpenseModal');
    const editForm = document.getElementById('editExpenseForm');

    // --- Logika untuk Modal "Add New Expense" ---
    window.showExpenseModal = function() {
        if (addModal) addModal.style.display = 'flex';
    };
    
    window.showAddModal = function() {
        if (addModal) addModal.style.display = 'flex';
    };
    
    window.hideAddModal = function() {
        if (addModal) addModal.style.display = 'none';
    };
    window.hideExpenseModal = function() {
        if (addModal) addModal.style.display = 'none';
    };

    // --- Logika untuk Modal "Edit Expense" ---
    window.showEditModal = function(expense) {
        if (!editModal || !editForm) return;
        
        // Set form action untuk update
        editForm.action = '/expenses/' + expense.id;
        
        // Populate form fields
        if (document.getElementById('edit_title')) {
            document.getElementById('edit_title').value = expense.title || '';
        }
        document.getElementById('edit_description').value = expense.description;
        document.getElementById('edit_amount').value = expense.amount;
        document.getElementById('edit_date').value = expense.date;
        document.getElementById('edit_category_id').value = expense.category_id;
        
        editModal.style.display = 'flex';
    };
    
    window.hideEditModal = function() {
        if (editModal) editModal.style.display = 'none';
    };

    // --- Logika untuk Delete Expense ---
    window.deleteExpense = function(expenseId) {
        if (confirm('Are you sure you want to delete this expense?')) {
            // Create form untuk delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/expenses/' + expenseId;
            
            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Add method spoofing untuk DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    };

    // Close modals saat klik di luar modal
    window.addEventListener('click', function(event) {
        if (event.target === addModal) {
            hideAddModal();
        }
        if (event.target === editModal) {
            hideEditModal();
        }
    });
});

