
<single-contact-form v-bind:display_id="display_id" inline-template>
    <!-- Widget -->
        <!-- Agent Widget -->
        <div class="agent-widget">

            <div v-if="alert" v-bind:class="getAlertClass()+'  mb-4 text-white'">
                <span  v-if="alertMessage !== ''" class="p-2">
                {{alertMessage}}
                </span>
            </div>
            <div class="form-group">
            <input type="text" v-model="name" placeholder="Your Name" required/>
            <form-error v-bind:errors="errors.name" v-if="errors.hasOwnProperty('name')" inline-template>
                <div class="p-1 mb-5 bg-red-800 text-white">
                    <ul class="list-none">
                        <li v-for="error in errors">
                            {{error}}
                        </li>
                    </ul>
                </div>
            </form-error>
            </div>

            <div class="form-group">
            <input type="email" v-model="email" placeholder="Your Email"
                   required
                   pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" />
            <form-error v-bind:errors="errors.email" v-if="errors.hasOwnProperty('email')" inline-template>
                <div class="p-1 mb-5 bg-red-800 text-white">
                    <ul class="list-none">
                        <li v-for="error in errors">
                            {{error}}
                        </li>
                    </ul>
                </div>
            </form-error>
            </div>

                <div class="form-group">
            <input type="tel" v-model="phone" placeholder="Your Phone" required minlength="6"/>
            <form-error v-bind:errors="errors.phone" v-if="errors.hasOwnProperty('phone')" inline-template>
                <div class="p-1 mb-5 bg-red-800 text-white">
                    <ul class="list-none">
                        <li v-for="error in errors">
                            {{error}}
                        </li>
                    </ul>
                </div>
            </form-error>
                </div>
            <div class="form-group">
            <input type="text" v-model="subject" placeholder="Your Subject" required />
            <form-error v-bind:errors="errors.subject" v-if="errors.hasOwnProperty('subject')" inline-template>
                <div class="p-1 mb-5 bg-red-800 text-white">
                    <ul class="list-none">
                        <li v-for="error in errors">
                            {{error}}
                        </li>
                    </ul>
                </div>
            </form-error>
            </div>
            <div class="form-group">
            <textarea v-model="message" required></textarea>
            <form-error v-bind:errors="errors.message" v-if="errors.hasOwnProperty('message')" inline-template>
                <div class="p-1 mb-5 bg-red-800 text-white">
                    <ul class="list-none">
                        <li v-for="error in errors">
                            {{error}}
                        </li>
                    </ul>
                </div>
            </form-error>
            </div>

            <button class="button fullwidth margin-top-5" @click="submitForm">
                Send Message
            </button>
        </div>
        <!-- Agent Widget / End -->

    <!-- Widget / End -->
</single-contact-form>