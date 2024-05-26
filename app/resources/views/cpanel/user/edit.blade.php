@extends('cpanel.layout.app')
@section('content')
    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600">
            Hai, {{ $profile["name"] ?? 'Developer' }}!
        </h2>
    </div>

    <div class="item-center place-item-center border border-black h-[30rem] w-[400px] rounded-[5px] m-[auto] mt-[50px]">

        <form>
            <div class="flex flex-col gap-1 ml-5 mt-[20px]">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="w-[350px] ">
            </div>
            
            <div class="flex flex-col gap-1 ml-5 mt-[20px]">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="w-[350px] ">    
            </div>
            
            <div class="flex flex-col gap-1 ml-5 mt-[20px]">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="w-[350px] ">    
            </div>

            <div class="flex flex-col gap-1 ml-5 mt-[20px]">
                <label for="role">Role</label>
                <select name="role" id="role" class="w-[350px]">
                    <option value="Kasir">Kasir</option>
                    <option value="Toko">Toko</option>
                </select>
            </div>

            <div class="flex flex-col gap-1 w-[100px] m-[auto] mt-[40px] ">
                <button class="px-2 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>

        


    </div>
@endsection