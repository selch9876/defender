

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Name</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name', optional($student ?? null)->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Email</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email', optional($student ?? null)->email) }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Phone</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="tel" class="form-control" placeholder="Phone" name="phone" value="{{ old('phone', optional($student ?? null)->phone) }}">
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Password</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="password" class="form-control" value="passwordonetwo" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="control-label col-md-3 col-sm-3 ">{{ __('Confirm Password') }}</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3" for="inputGroupSelect01">Starting Date</label>
                    
                    @php
                        $currentDate = date("Y/m/d"); 
                        $effectiveDate = date('Y-m-d', strtotime("+6 months", strtotime($currentDate)));
                    @endphp
                    <div class="col-md-9 col-sm-9 ">
                        <input type="date" name="dateStart" min="{{ $currentDate }}" value="" id="startDate" onBlur="setSubDate()" />
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="thumbnail"></label>
                    <input type="file" id="thumbnail" class="form-control-file" name="thumbnail">
                </div>
