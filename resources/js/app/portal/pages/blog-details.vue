<template>

    <main class="w-full">
        <div class="mx-auto max-w-7xl px-5 pt-5 pb-16 w-full">

            <!-- card image -->
            <div class="pt-5 w-full">
                <img :src="'/collection/food.jpeg'" class="w-full object-cover bg-cover min-h-[450px] max-h-[450px] rounded-md" alt="food" />
            </div>
            <!-- / card image -->

            <div class="text-xs mt-3 font-medium flex justify-between gap-3 opacity-70">

                <div class="flex items-center justify-end gap-3">

                    <!-- card comments -->
                    <div class="inline-flex justify-end items-center gap-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div> {{countNumber(150)}} </div>
                    </div>
                    <!-- / card comments -->

                    <!-- card comments -->
                    <div class="inline-flex justify-end items-center gap-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                            </svg>
                        </div>
                        <div> {{countNumber(2000)}} </div>
                    </div>
                    <!-- / card comments -->

                    <!-- card share -->
                    <div class="inline-flex justify-end items-center gap-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                        </div>
                        <div> {{countNumber(1200)}} </div>
                    </div>
                    <!-- / card share -->

                </div>

                <!-- card date -->
                <div> 25 Sep 2025 </div>
                <!-- / card date -->

            </div>

            <!-- card title -->
            <div class="text-lg mt-3 block font-medium">
                Decadent Caramel Pancake Stack with Fresh Berries
            </div>
            <!-- / card title -->

            <!-- card description -->
            <div class="text-sm block my-3 font-normal">
                    Indulge in a sumptuous breakfast experience with this towering stack of fluffy pancakes, generously drizzled with rich, golden caramel sauce. Each layer is perfectly cooked to a soft, airy texture, creating a delightful contrast with the slightly crisp edges. The pancakes are topped with a medley of fresh strawberries and nuts, adding bursts of flavor and a satisfying crunch in every bite.
                </div>

            <!-- card inner image -->
            <div class="max-w-[650px] my-10 w-full mx-auto">
                    <img :src="'/collection/food.jpeg'" class="w-full object-cover bg-cover rounded-lg h-full min-h-[350px] max-h-[350px]" alt="food" />
                </div>
            <!-- / card inner image -->

            <div class="text-sm block my-3 font-normal">
                    The harmony of sweetness from the caramel and the freshness of the berries creates a sensory delight that elevates a simple breakfast into a gourmet treat. A light dusting of powdered sugar enhances the visual appeal, making this dish as pleasing to the eyes as it is to the palate. Accompanied by a dollop of creamy whipped topping, each bite melts in your mouth, leaving behind a lingering taste of pure indulgence.
                </div>

            <div class="text-sm block my-3 font-normal">
                    "Good food is the foundation of genuine happiness." This pancake creation embodies that philosophy, offering both comfort and luxury in one plate. Perfect for leisurely weekend mornings or special brunches, it transforms an ordinary meal into an unforgettable experience, reminding us that sometimes, joy is found in the simplest pleasures.
                </div>

            <!-- quote -->
            <div class="text-sm block my-5 font-medium bg-white border-s-4 border-s-blue-400 p-5">
                    <q>
                        The harmony of sweetness from the caramel and the freshness of the berries creates a sensory delight that elevates a simple breakfast into a gourmet treat. A light dusting of powdered sugar enhances the visual appeal, making this dish as pleasing to the eyes as it is to the palate. Accompanied by a dollop of creamy whipped topping, each bite melts in your mouth, leaving behind a lingering taste of pure indulgence.
                    </q>
                </div>
            <!-- / quote -->

            <div class="text-sm block my-3 font-normal">
                    Indulge in a sumptuous breakfast experience with this towering stack of fluffy pancakes, generously drizzled with rich, golden caramel sauce. Each layer is perfectly cooked to a soft, airy texture, creating a delightful contrast with the slightly crisp edges. The pancakes are topped with a medley of fresh strawberries and nuts, adding bursts of flavor and a satisfying crunch in every bite.
                </div>

            <div class="text-sm block my-3 font-normal">
                    The harmony of sweetness from the caramel and the freshness of the berries creates a sensory delight that elevates a simple breakfast into a gourmet treat. A light dusting of powdered sugar enhances the visual appeal, making this dish as pleasing to the eyes as it is to the palate. Accompanied by a dollop of creamy whipped topping, each bite melts in your mouth, leaving behind a lingering taste of pure indulgence.
                </div>

            <div class="text-sm block my-3 font-normal">
                    "Good food is the foundation of genuine happiness." This pancake creation embodies that philosophy, offering both comfort and luxury in one plate. Perfect for leisurely weekend mornings or special brunches, it transforms an ordinary meal into an unforgettable experience, reminding us that sometimes, joy is found in the simplest pleasures.
                </div>
            <!-- / card description -->

        </div>
    </main>

</template>

<script>

export default {
    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

        countNumber(num) {
            if (num >= 1_000_000_000) {
                return (num / 1_000_000_000).toFixed(1).replace(/\.0$/, '') + 'b';
            } else if (num >= 1_000_000) {
                return (num / 1_000_000).toFixed(1).replace(/\.0$/, '') + 'm';
            } else if (num >= 1_000) {
                return (num / 1_000).toFixed(1).replace(/\.0$/, '') + 'k';
            } else {
                return num.toString();
            }
        }

    }
}

</script>
