@extends('frontend.layouts.layout')

@section('head')
    <title>Checkout | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')
{{ session(['link' => url()->current()]) }}
<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url({{ asset('images/bg/02.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>Shop checkout</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="#">Shop</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Shop checkout </span> </li>
         </ul>
       </div>
       </div>
    </div>
</section>

<section class="page-section-ptb">
    <div class="container">
      <div class="row">
        <h2 class="mb-20 text-center" style="width: -webkit-fill-available;">Order details</h2>
      </div>
      @include('common.partials.flash')
      <form role="form"
      method="post"
      class="require-validation"
      data-cc-on-file="false"
      data-stripe-publishable-key="{{ config('app.stripe_key') }}"
      id="payment-form" action="{{ route('generate.order') }}">
        @csrf
        <div class="row">
           <div class="col-md-6">
             <table class="table table-responsive">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($postCarts as $postCart)
                    <tr>
                      <td>
                        <div class="product-image">
                          <img class="img-fluid mx-auto" style="width:50px;height:58px;" src="{{ asset('/storage/'. $postCart->post->getMetaData('featured_image')) }}">
                        </div>
                      </td>
                      <td><p>{{ $postCart->post->title }}</p></td>
                      @php
                      $discount = $postCart->post->getMetaData('price') - ($postCart->post->getMetaData('price') * ($postCart->post->getMetaData('discount')/100));
                      @endphp
                      <td><p>${{ $postCart->price ? $postCart->price : ($postCart->post->getMetaData('discount') ? $discount : $postCart->post->getMetaData('price')) }}</p></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                  <th>Subtotal</th>
                    <td>
                      <p>${{ $postCarts->sum('price') }}</p>
                    </td>
                </tr>
                <tr>
                   <th>Shipping</th>
                  <td>
                    <div class="clearfix">
                       <label>
                         <span>Free Shipping</span>
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><p class="price">${{ $postCarts->sum('price') }}</p></td>
                    </tr>
                </tfoot>
                </table>
           </div>
           <div class="col-md-6">
            <div class="gray-bg  pl-50 pr-50 pt-50 pb-50">
                <div class="payment-method mb-10">
                    <div class="row">
                        <div class="col-md-6" style="display:flex;">
                            <input type="radio" width="40" class="form-control radio" id="stripe-radio" name="payment" style="    margin-top: 19px;height: 21px;" value="stripe">
                            <label  style="font-size:25px;margin-top:10px;" for="stripe"><b>Stripe</b></label><br>
                        </div>
                        <div class="col-md-6" style="display:flex;">
                            <input type="radio" width="40" class="form-control radio" style="    margin-top: 19px;height: 21px;" id="paypal-radio" name="payment" value="paypal">
                            <label  style="font-size:25px;margin-top:10px;" for="paypal"><b>Paypal</b></label><br>
                        </div>
                    </div>
                </div>
                    <div id="stripe-form">
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-6 col-lg-6 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    style="background:#fff;" class='form-control' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-6 col-lg-6 form-group card required' style="border:none;background-color:transparent;">
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' style="background:#fff;" class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    style="background:#fff;" class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    style="background:#fff;" class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    style="background:#fff;" class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
                        <input type="hidden" name="price" value="{{ $postCarts->sum('price') }}" />
                        <input type="hidden" id="method-stripe" name="method" value="stripe" />
                        <div class="row" style="justify-content: center">
                            <div class="col-xs-12">
                                <input type="submit" class="button btn-block" value="Place Order Now ${{ $postCarts->sum('price') }}"><span class="icon-action-redo"></span>
                            </div>
                        </div>
                    </div>
                    <div id="paypal-form">
                            <input type="hidden" name="amount" value="{{ $postCarts->sum('price') }}"/>
                            <input type="hidden" id="method-paypal" name="method" value="paypal" />
                            <div class="row" style="justify-content: center">
                                <div class="col-xs-12">
                                    <input type="submit" class="button btn-block" value="Place Order Now ${{ $postCarts->sum('price') }}"><span class="icon-action-redo"></span>
                                </div>
                            </div>
                    </div>
               </div>
           </div>
        </div>
    </form>
    </div>
</section>

@endsection
@push('scripts')
<script>
            $('#stripe-form').hide();
            $('#paypal-form').hide();
            $('#paypal-radio').click(function(){
                $('#stripe-form').hide();
                $('#paypal-form').show();
                var method = document.getElementById('method-stripe');
                method.removeAttribute('name');
                // var form = document.getElementById('payment-form');
                // form.removeAttribute('class');
                // form.removeAttribute('role');
                // form.removeAttribute('data-cc-on-file');
                // form.removeAttribute('data-stripe-publishable-key');
            });

            $('#stripe-radio').click(function(){
                $('#paypal-form').hide();
                $('#stripe-form').show();
                var method = document.getElementById('method-paypal');
                method.removeAttribute('name');
                // var form = document.getElementById('payment-form');
                // form.setAttribute('class', 'require-validation');
                // form.setAttribute('role', 'form');
                // form.setAttribute('data-cc-on-file', 'false');
                // form.setAttribute('data-stripe-publishable-key', '{{ config("app.stripe_key")}} ');
            });

</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript">
$('#stripe-radio').click(function(){

      var $form = $(".require-validation");

      $('form.require-validation').bind('submit', function(e) {
          var $form         = $(".require-validation"),
          inputSelector = ['input[type=email]', 'input[type=password]',
                           'input[type=text]', 'input[type=file]',
                           'textarea'].join(', '),
          $inputs       = $form.find('.required').find(inputSelector),
          $errorMessage = $form.find('div.error'),
          valid         = true;
          $errorMessage.addClass('hide');

          $('.has-error').removeClass('has-error');
          $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
              $input.parent().addClass('has-error');
              $errorMessage.removeClass('hide');
              e.preventDefault();
            }
          });

          if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
              number: $('.card-number').val(),
              cvc: $('.card-cvc').val(),
              exp_month: $('.card-expiry-month').val(),
              exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
          }

    });

    function stripeResponseHandler(status, response) {
          if (response.error) {
              $('.error')
                  .removeClass('hide')
                  .find('.alert')
                  .text(response.error.message);
          } else {
              /* token contains id, last4, and card type */
              var token = response['id'];

              $form.find('input[type=text]').empty();
              $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
              $form.get(0).submit();
          }
      }

  });
  </script>

@endpush
