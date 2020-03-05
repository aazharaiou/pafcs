<h4>Dashboard</h4>
<nav class="navbar border border-primary" style="z-index: 999;">
<ul class="navbar-nav">
	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Users</a>
		<div class="dropdown-menu">
			<a href="{{ url('user/create') }}" class="dropdown-item">Create User</a>
			<a href="{{ url('/user') }}" class="dropdown-item">List Users</a>
		    
		</div>
	</li>

	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Vendor</a>
		<div class="dropdown-menu">
			<a href="{{ url('vendor/create') }}" class="dropdown-item">Create Vendor</a>
			<a href="{{ url('vendor') }}" class="dropdown-item">List Vendors</a>
		    
			
		</div>
	</li>

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Territory</a>
		<div class="dropdown-menu">
			<a href="{{ url('territory/create') }}" class="dropdown-item">Create Territory</a>
			<a href="{{ url('territory') }}" class="dropdown-item">List Territory</a>
			
		</div>
	</li> --}}

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Shipper</a>
		<div class="dropdown-menu">
			<a href="{{ url('shipper/create') }}" class="dropdown-item">Create Shipper</a>
			<a href="{{ url('shipper') }}" class="dropdown-item">List Shippers</a>
		</div>
	</li> --}}

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Customer</a>
		<div class="dropdown-menu">
			<a href="{{ url('customer/create') }}" class="dropdown-item">Create Customer</a>
			<a href="{{ url('customer') }}" class="dropdown-item">List Customer</a>
			<a href="{{ url('customerproduct') }}" class="dropdown-item">Customer Products List</a>
			<a href="{{ url('cppf') }}" class="dropdown-item">Customer Products Profile</a>
		</div>
	</li>
 --}}
	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Product</a>
		<div class="dropdown-menu">
			<a href="{{ url('product/create') }}" class="dropdown-item">Create Product</a>
			<a href="{{ url('product') }}" class="dropdown-item">List Product</a>
			
		</div>
	</li>

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Purchase</a>
		<div class="dropdown-menu">
			<a href="{{ url('purchase/create') }}" class="dropdown-item">Create Purchase</a>
			<a href="{{ url('purchase') }}" class="dropdown-item">List Purchase</a>
			
		</div>
	</li> --}}

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Order</a>
		<div class="dropdown-menu">
			<a href="{{ url('order/create') }}" class="dropdown-item">Create Order</a>
			<a href="{{ url('order') }}" class="dropdown-item">List Orders</a>
			<a href="{{ url('partialorders') }}" class="dropdown-item">Partial Orders</a>
		</div>
	</li> --}}
{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Order Tracking</a>
		<div class="dropdown-menu">
			<a href="{{ url('otdatewise') }}" class="dropdown-item">Date Wise Orders</a>
			<a href="{{ url('otracking') }}" class="dropdown-item">Warehouse Wise Orders</a>
			<a href="{{ url('dctracking') }}" class="dropdown-item">Warehouse Wise DC</a>
		</div>
	</li> --}}
{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pending Order List</a>
		<div class="dropdown-menu">
			<a href="{{ url('pendingorder/create') }}" class="dropdown-item">Create Pending Order</a>
			<a href="{{ url('pendingorder') }}" class="dropdown-item">List Pending Orders</a>

		</div>
	</li> --}}
	{{-- <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sale</a>
		<div class="dropdown-menu">
			<a href="{{ url('sale') }}" class="dropdown-item">Orders List For Posting</a>
			<a href="{{ url('sale/list') }}" class="dropdown-item">Sales List</a>
		</div>
	</li> --}}
	{{-- <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sale to be Dilevered</a>
		<div class="dropdown-menu">
			<a href="{{ url('sale/tobedeliver') }}" class="dropdown-item">Sales List</a>
		</div>
		
	</li> --}}
	{{-- <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sale Return</a>
		<div class="dropdown-menu">
			<a href="{{ url('salereturn') }}" class="dropdown-item">Sales List</a>
			<a href="{{ url('salereturn/list') }}" class="dropdown-item">Sales Return List</a>
			
		</div>
		
	</li> --}}
	
{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Invoice</a>
		<div class="dropdown-menu">
			<a href="{{ url('invoice/create') }}" class="dropdown-item">Create Invoice</a>
			<a href="{{ url('invoice') }}" class="dropdown-item">List Invoices</a>
			
		</div>
		
	</li> --}}

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Payments</a>
		<div class="dropdown-menu">
			<a href="{{ url('payment/create') }}" class="dropdown-item">Create Payment</a>
			<a href="{{ url('payment') }}" class="dropdown-item">List Payments</a>
		</div>
		
	</li> --}}

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Reports</a>
		<div class="dropdown-menu">
			<a href="{{ url('reports/full_stock') }}" class="dropdown-item" target="_blank">Over All Stock</a>
			<a href="{{ url('reports/warehouses') }}" class="dropdown-item">Warehouse Wise </a>
			<a href="{{ url('reports/pwledger') }}" class="dropdown-item">Product Wise Ledger</a>
			<a href="{{ url('reports/reorder') }}" class="dropdown-item" target="_blank">Reorder</a>
			<a href="{{ url('reports/nearexpiry') }}" class="dropdown-item" target="_blank">Near to Expiry</a>
			<a href="{{ url('reports/c_wise_p_sale') }}" class="dropdown-item">Customer Wise Product Sale</a>
			<a href="{{ url('reports/all_territory_wise_p_sale') }}" class="dropdown-item">Territory Wise Product Sale</a>
			<a href="{{ url('reports/dcpw') }}" class="dropdown-item">Data Comparison Product Wise</a>
			<a href="{{ url('reports/dccw') }}" class="dropdown-item">Data Comparison Customer Wise</a>
			<a href="{{ url('reports/cwl') }}" class="dropdown-item">Customer Wise Ledger</a>
			<a href="{{ url('sale/datewise') }}" class="dropdown-item">Date Wise Sales</a>
			<a href="{{ url('sale/spricep') }}" class="dropdown-item">Sale Price Product Wise</a>
		</div>
		
	</li> --}}

{{-- 	<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Graphs</a>
		<div class="dropdown-menu">
			<a href="{{ url('/graph/bgtvwise') }}" class="dropdown-item">Bar Graph Territory/Vendor Wise Products Sale</a>
			<a href="{{ url('graph/bgmwise') }}" class="dropdown-item">Bar Graph Month Wise Products Sale</a>
			<a href="{{ url('/graph/bgqwise') }}" class="dropdown-item">Bar Graph Quarterly Wise Products Sale</a>
			<a href="{{ url('/graph/bgywise') }}" class="dropdown-item">Bar Graph Year Wise Products Sale</a>
			
			<a href="{{ url('graph/piemwise') }}" class="dropdown-item">Pie Graph Month Wise Products Sale</a>
			<a href="{{ url('/graph/pieqwise') }}" class="dropdown-item">Pie Graph Quarterly Wise Products Sale</a>
			<a href="{{ url('/graph/pieywise') }}" class="dropdown-item">Pie Graph Year Wise Products Sale</a>

		</div>
		
	</li> --}}

	{{-- <li class="nav-item"><a href="#" class="nav-link">Menu Item 2</a></li>
	<li class="nav-item"><a href="#" class="nav-link">Menu Item 3</a></li> --}}
</ul>
</nav>