export const CategoryService = {
    getCustomersSmall() {
        return Promise.resolve([
            {
                id: 1,
                name: "John Doe",
                country: {
                    name: "United States",
                    code: "us"
                },
                representative: {
                    name: "Amy Elsner",
                    image: "amyelsner.png"
                },
                status: "qualified"
            },
            {
                id: 2,
                name: "Maria Garcia",
                country: {
                    name: "Spain",
                    code: "es"
                },
                representative: {
                    name: "Anna Fali",
                    image: "annafali.png"
                },
                status: "new"
            },
            {
                id: 3,
                name: "Kenji Tanaka",
                country: {
                    name: "Japan",
                    code: "jp"
                },
                representative: {
                    name: "Ivan Magalhaes",
                    image: "ivanmagalhaes.png"
                },
                status: "negotiation"
            },
            {
                id: 4,
                name: "Juan Dela Cruz",
                country: {
                    name: "Philippines",
                    code: "ph"
                },
                representative: {
                    name: "Stephen Shaw",
                    image: "stephenshaw.png"
                },
                status: "proposal"
            },
            {
                id: 5,
                name: "Anna Schmidt",
                country: {
                    name: "Germany",
                    code: "de"
                },
                representative: {
                    name: "Onyama Limba",
                    image: "onyamalimba.png"
                },
                status: "renewal"
            }
        ]);
    }
};