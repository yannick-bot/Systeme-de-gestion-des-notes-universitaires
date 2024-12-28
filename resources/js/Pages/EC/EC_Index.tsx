import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { InertiaLink } from '@inertiajs/inertia-react'


interface EC {
    id: number;
    code: string,
    name: string,
    credits_ects: number,
    semestre: number
}

interface Data {
    ecs: EC[]
}

export default function Index({ ecs }: Data) {
    return (
        <AuthenticatedLayout
            header={
                <div className='flex justify-between'>
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        EC
                    </h2>
                    <InertiaLink href={route('EC.create')}>
                        <i className="ri-add-box-fill" style={{fontSize: '30px'}}></i>
                    </InertiaLink>
                </div>
            }
        >
            <Head title="UE_List" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-5">
                        <table cellPadding="50" border={1} align="center">
                            <thead>
                                <tr>
                                    <th>Code UE</th>
                                    <th>Nom</th>
                                    <th>ECTS</th>
                                    <th>Semestre</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                {
                                    ecs.map(ec =>
                                        (
                                            <tr key={ec.id}>
                                                <td>{ec.code}</td>
                                                <td>{ec.name}</td>
                                                <td>{ec.credits_ects}</td>
                                                <td>{ec.semestre}</td>
                                                <td className='flex'>
                                                    <InertiaLink href={route('EC.edit', {ec})}>
                                                        <button className='rounded-xl p-2 border-2'>EDIT</button>
                                                    </InertiaLink>
                                                    <InertiaLink href={route('EC.destroy', {ec})}>
                                                        <button className='rounded-xl p-2 border-2'>DELETE</button>
                                                    </InertiaLink>
                                                </td>
                                            </tr>
                                        )
                                    )
                                }

                            </tbody>
            </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}



