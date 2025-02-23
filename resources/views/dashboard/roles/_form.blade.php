{{-- Name --}}
<div class="col-md-6">
    <x-form.input class="form-control" type="text" label="role Name" name="name" :value="$role->name"
                  placeholder="role Name"/>
</div>

<fieldset>
    <legend>
        {{__('Abilities')}}
    </legend>

    @foreach(config('abilites') as $ability_code =>$ability_name)
        <div class="row mb-2 ">
            <div class="col-md-6">
                {{$ability_name}}
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{$ability_code}}]"
                       value="allow" @checked(($role_abilities[$ability_code] ??'') ==='allow' )>
                Allow
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{$ability_code}}]" value="deny" @checked(($role_abilities[$ability_code] ??'') ==='deny' )>
                Deny
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{$ability_code}}]" value="inherit" @checked(($role_abilities[$ability_code] ??'') ==='inherit' )>
                Inherit
            </div>
        </div>
    @endforeach
</fieldset>
<div>
    {{-- <button type="submit" class="btn btn-primary">{{ isset($role) ? 'Update' : 'Create' }}</button> --}}
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
</div>
