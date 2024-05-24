<template>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-white">Briefs</h1>
            <a href="{{ url('/admin') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Login
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full table-auto">
                <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-3 text-left">Nom</th>
                    <th class="px-4 py-3 text-left">Branche</th>
                    <th class="px-4 py-3 text-left">Niveau</th>
                    <th class="px-4 py-3 text-left">PDF</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="brief in briefs" :key="brief.id" class="border-b">
                    <td class="px-4 py-3">{{ brief.name }}</td>
                    <td class="px-4 py-3">{{ brief.briefBranch.name }}</td>
                    <td class="px-4 py-3">{{ brief.briefLevel.number }}</td>
                    <td class="px-4 py-3">
                        <a v-if="brief.attachment" :href="'/storage/' + brief.attachment" target="_blank" class="text-blue-500 hover:text-blue-700">
                            <img src="{{ asset('') }}" alt="PDF" class="w-5 h-5">
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        briefs: {
            type: Array,
            required: true,
        },
    },
}

</script>
