@if(session('edit_user'))
<div class="alert alert-success text-center">
    <p>{{ session('edit_user') }}</p>
</div>
@endif

@if(session('edit_password'))
<div class="alert alert-success text-center">
    <p>{{ session('edit_password') }}</p>
</div>
@endif

@if(session('store_subscribe'))
<div class="alert alert-success text-center">
    <p>{{ session('store_subscribe') }}</p>
</div>
@endif

@if(session('store_review'))
<div class="alert alert-primary text-center">
    <p>{{ session('store_review') }}</p>
</div>
@endif

@if(session('store_reserve'))
<div class="alert alert-primary text-center">
    <p>{{ session('store_reserve') }}</p>
</div>
@endif

@if(session('cancel_reserve'))
<div class="alert alert-warning text-center">
    <p>{{ session('cancel_reserve') }}</p>
</div>
@endif

@if(session('update_credit'))
<div class="alert alert-success text-center">
    <p>{{ session('update_credit') }}</p>
</div>
@endif

@if(session('add_delete_flag'))
<div class="alert alert-success text-center">
    <p>{{ session('add_delete_flag') }}</p>
</div>
@endif

@if(session('del_delete_flag'))
<div class="alert alert-success text-center">
    <p>{{ session('del_delete_flag') }}</p>
</div>
@endif

@if(session('success_inquiries'))
<div class="alert alert-primary text-center">
    <p>{{ session('success_inquiries') }}</p>
</div>
@endif

@if($errors->any() || session('error_password'))
<div class="alert alert-danger text-center">
    <p>入力事項に誤りがあります。</p>
</div>
@endif
