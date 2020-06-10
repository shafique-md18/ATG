@component('mail::message')

## Information submitted successfully at: http://shafique-atg.herokuapp.com/

### Thanks for filling in the form!
### We have sent in this email to confirm that your information has been received by our team!
### - Below are the details that you have entered!
 - **Name:** {{ $data['name'] }}
 - **Email:** {{ $data['email'] }}
 - **Pincode:** {{ $data['pincode'] }}


@endcomponent
