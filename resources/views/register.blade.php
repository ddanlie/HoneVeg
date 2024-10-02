<x-default>
    <x-postHeaderContent>
        
            <div style="width:20%; margin:auto; padding:5% 0 2% 0">
                <form method="POST" action="/register">
                    @csrf
                    <h1 >Join our market!</h1>
                    
                    <label>
                        <h2 style="text-align: left; margin:8% 0 0 10%;">Email</h2>
                        <input type="email" required style="padding: 5px; border-radius: 20px;">
                    </label>
                    <label>
                        <h2 style="text-align: left; margin:8% 0 0 10%;">Name</h2>
                        <input type="text" required style="padding: 5px; border-radius: 20px;">
                    </label>
                    <label>
                        <h2 style="text-align: left; margin:8% 0 0 10%;">Password</h2>
                        <input type="password" required style="padding: 5px; border-radius: 20px;">
                    </label>
                    <x-defaultButton style="margin-top: 15%; color:white; background-color: var(--green-style);">Register</x-defaultButton>
                </form>
            </div>


    </x-postHeaderContent>
</x-default>
