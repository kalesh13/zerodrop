<form class="mb-5" action="{{url('contact')}}" method="post">
    @csrf
    <div class="form-col md">
        <div class="column two-col">
            <input class="form-control" type="text" name="first_name" placeholder="First Name" required/>
        </div>
        <div class="column two-col">
            <input class="form-control" type="text" name="last_name" placeholder="Last Name"/>
        </div>
    </div>
    <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Email Address" required/>
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="phone" placeholder="Phone Number" required/>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Message"></textarea>
    </div>
    <input type="submit" class="theme-btn contact-btn w-100" value="Send Message"/>
</form>
